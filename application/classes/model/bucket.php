<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for Buckets
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    SwiftRiver - http://github.com/ushahidi/Swiftriver_v2
 * @category   Models
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v3 (GPLv3) 
 */
class Model_Bucket extends ORM {
	
	/**
	 * No. of droplets to return on each fetch
	 */
	const DROPLETS_PER_PAGE = 20;
	
	/**
	 * One-to-many relationship definitions
	 * @var array Relationhips
	 */
	protected $_has_many = array( 
		// A bucket has many droplets
		'droplets' => array(
			'model' => 'droplet',
			'through' => 'buckets_droplets'
			),
		
		// A bucket has many collaborators
		'bucket_collaborators' => array(),

		// A bucket has many collaborators
		'comments' => array(),		

		// A bucket has many subscribers
		'subscriptions' => array(
			'model' => 'user',
			'through' => 'bucket_subscriptions',
			'far_key' => 'user_id'
			)
	);

	/**
	 * A bucket belongs to an account and a user
	 * @var array Relationhips
	 */
	protected $_belongs_to = array(
		'account' => array(),
		'user' => array()
	);


	/**
	 * Rules for the bucket model. 
	 *
	 * @return array Rules
	 */
	public function rules()
	{
		return array(
			'bucket_name' => array(
				array('not_empty'),
				array('max_length', array(':value', 25)),
			),
			'bucket_publish' => array(
				array('in_array', array(':value', array('0', '1')))
			),
		);
	}
	
	
	/**
	 * Override saving to perform additional functions on the bucket
	 */
	public function save(Validation $validation = NULL)
	{
		// Do this for first time buckets only
		if ($this->loaded() === FALSE)
		{
			// Save the date the bucket was first added
			$this->bucket_date_add = date("Y-m-d H:i:s", time());
		}
		
		// Set river_name_url as river_name sanitized
		$this->bucket_name_url = URL::title($this->bucket_name);

		$bucket = parent::save();

		// Swiftriver Plugin Hook -- execute after saving a bucket
		Swiftriver_Event::run('swiftriver.bucket.save', $bucket);

		return $bucket;
	}

	/**
	 * Override default delete behaviour to delete subscriptions
	 * and bucket droplets before deleting the bucket entry
	 * from the DB
	 */
	public function delete()
	{
		// Delete the bucket's droplets
		DB::delete('buckets_droplets')
		   ->where('bucket_id', '=', $this->id)
		   ->execute();

		// Remove the subscriptions
		DB::delete('bucket_subscriptions')
		    ->where('bucket_id', '=', $this->id)
		    ->execute();

		parent::delete();
	}

	/**
	 * Gets the base URL of this bucket
	 *
	 * @return string
	 */
	public function get_base_url()
	{
		return URL::site().$this->account->account_path.'/bucket/'.$this->bucket_name_url;
	}	
	
	/**
	 * Get the droplets for the specified bucket
	 *
	 * @param int $user_id Logged in user id	
	 * @param int $id ID of the Bucket
	 * @return array $droplets Total and Array of Droplets
	 */
	public static function get_droplets($user_id, $bucket_id = NULL, $drop_id = 0, $page = NULL, $max_id = PHP_INT_MAX)
	{
		$droplets = array(
			'total' => 0,
			'droplets' => array()
			);
		
		$bucket_orm = ORM::factory('bucket', $bucket_id);
		if ($bucket_orm->loaded())
		{
			// Build Buckets Query
			$query = DB::select(array('droplets.id', 'id'), array('buckets_droplets.id', 'sort_id'),
								'droplet_title', 'droplet_content', 
								'droplets.channel','identity_name', 'identity_avatar', 
								array(DB::expr('DATE_FORMAT(droplet_date_pub, "%b %e, %Y %H:%i UTC")'),'droplet_date_pub'),
								array(DB::expr('SUM(all_scores.score)'),'scores'), array('user_scores.score','user_score'))
				->from('droplets')
				->join('buckets_droplets', 'INNER')
				->on('buckets_droplets.droplet_id', '=', 'droplets.id')
				->join('identities')
				->on('droplets.identity_id', '=', 'identities.id')
				->join(array('droplet_scores', 'all_scores'), 'LEFT')
			    ->on('all_scores.droplet_id', '=', 'droplets.id')
			    ->join(array('droplet_scores', 'user_scores'), 'LEFT')
			    ->on('user_scores.droplet_id', '=', DB::expr('droplets.id AND user_scores.user_id = '.$user_id))
				->where('buckets_droplets.bucket_id', '=', $bucket_id)
				->where('droplets.droplet_processed', '=', 1);
				
			if ($drop_id)
			{
				// Return a specific drop
				$query->where('droplets.id', '=', $drop_id);
			}
			else
			{
				// Return all drops
				$query->where('buckets_droplets.id', '<=', $max_id);
			}
			
				
			// Order & Pagination offset
			$query->group_by('buckets_droplets.id');
			$query->order_by('buckets_droplets.droplet_date_added', 'DESC');
			$query->order_by('droplets.id', 'DESC');
			if ($page)
			{
				$query->limit(self::DROPLETS_PER_PAGE); 
				$query->offset(self::DROPLETS_PER_PAGE * ($page - 1));
			}
			
			// Get our droplets as an Array		
			$droplets['droplets'] = $query->execute()->as_array();
			
			// Encode content and title as utf8 in case they arent
			foreach ($droplets['droplets'] as & $droplet) 
			{
				Model_Droplet::utf8_encode($droplet);
			}


			// Populate buckets array			
			Model_Droplet::populate_buckets($droplets['droplets']);
			
			// Populate tags array			
			Model_Droplet::populate_tags($droplets['droplets'], $bucket_orm->account_id);
			
			// Populate links array			
			Model_Droplet::populate_links($droplets['droplets'], $bucket_orm->account_id);
			
			// Populate places array			
			Model_Droplet::populate_places($droplets['droplets'], $bucket_orm->account_id);
			
			// Populate the discussions array
			Model_Droplet::populate_discussions($droplets['droplets']);
			
			$droplets['total'] = count($droplets['droplets']);
		}

		return $droplets;
	}

	/**
	 * Get the droplets newer than the specified id
	 *
	 * @param int $user_id Logged in user id	
	 * @param int $id ID of the Bucket
	 * @return array $droplets Total and Array of Droplets
	 */
	public static function get_droplets_since_id($user_id, $bucket_id, $since_id)
	{
		$droplets = array(
			'total' => 0,
			'droplets' => array()
			);
		
		$bucket_orm = ORM::factory('bucket', $bucket_id);
		if ($bucket_orm->loaded())
		{		
			// Build Buckets Query
			$query = DB::select(array('droplets.id', 'id'), array('buckets_droplets.id', 'sort_id'),
								'droplet_title', 'droplet_content', 
								'droplets.channel','identity_name', 'identity_avatar', 
								array(DB::expr('DATE_FORMAT(droplet_date_pub, "%b %e, %Y %H:%i UTC")'),'droplet_date_pub'),
			                    array(DB::expr('SUM(all_scores.score)'),'scores'), array('user_scores.score','user_score'))
				->from('droplets')
				->join('buckets_droplets', 'INNER')
				->on('buckets_droplets.droplet_id', '=', 'droplets.id')
				->join('identities')
				->on('droplets.identity_id', '=', 'identities.id')
				->join(array('droplet_scores', 'all_scores'), 'LEFT')
			    ->on('all_scores.droplet_id', '=', 'droplets.id')
			    ->join(array('droplet_scores', 'user_scores'), 'LEFT')
			    ->on('user_scores.droplet_id', '=', DB::expr('droplets.id AND user_scores.user_id = '.$user_id))
				->where('buckets_droplets.bucket_id', '=', $bucket_id)
				->where('droplets.droplet_processed', '=', 1)
				->where('buckets_droplets.id', '>', $since_id)
				->group_by('buckets_droplets.id')
				->order_by('buckets_droplets.id', 'ASC');
				
			// Get our droplets as an Array		
			$droplets['droplets'] = $query->execute()->as_array();
			$droplets['total'] = count($droplets['droplets']);
			
			// Encode content and title as utf8 in case they arent
			foreach ($droplets['droplets'] as & $droplet) 
			{
				Model_Droplet::utf8_encode($droplet);
			}
			
			// Populate buckets array			
			Model_Droplet::populate_buckets($droplets['droplets']);
			
			// Populate tags array			
			Model_Droplet::populate_tags($droplets['droplets'], $bucket_orm->account_id);
			
			// Populate links array			
			Model_Droplet::populate_links($droplets['droplets'], $bucket_orm->account_id);			
			
			// Populate places array			
			Model_Droplet::populate_places($droplets['droplets'], $bucket_orm->account_id);

			// Populate the discussions array
			Model_Droplet::populate_discussions($droplets['droplets']);
			
		}

		return $droplets;
	}	
	
	/**
	 * Create a bucket from an array
	 *
	 * @param array
	 * @return Model_Bucket
	 */
	public static function create_from_array($bucket_array)
	{		
		$bucket_orm = ORM::factory('bucket');
		$bucket_orm->account_id = $bucket_array['account_id'];
		$bucket_orm->user_id = $bucket_array['user_id'];
		$bucket_orm->bucket_name = $bucket_array['bucket_name'];
		$bucket_orm->save();
		return $bucket_orm;
	}
	
	/**
	 * Gets a buckets's collaborators as an array
	 *
	 * @return array
	 */	
	public function get_collaborators($active_only = FALSE)
	{
		$collaborators = array();		
		foreach ($this->bucket_collaborators->find_all() as $collaborator)
		{
			if ($active_only AND ! (bool) $collaborator->collaborator_active)
				continue;
			
			$collaborators[] = array('id' => $collaborator->user->id, 
			                         'name' => $collaborator->user->name,
			                         'account_path' => $collaborator->user->account->account_path,
			                         'collaborator_active' => $collaborator->collaborator_active,
			                         'avatar' => Swiftriver_Users::gravatar($collaborator->user->email, 40)
			);
		}
		
		return $collaborators;
	}

	/**
	 * Gets a buckets's discussion
	 *
	 * @param int - signed in user
	 * @return array
	 */	
	public function get_comments($user_id = 0)
	{
		$comments = array();
		$i = 0;	
		foreach ($this->comments->find_all() as $comment)
		{
			$comments[$i] = array(
				'id' => $comment->id, 
				'name' => $comment->user->name,
				'comment_content' => $comment->comment_content,
				'date' => $comment->comment_date_add,
				'avatar' => Swiftriver_Users::gravatar($comment->user->email, 40),
				'score' => 0
			);

			// Attach [signed in] users score
			if ($user_id)
			{
				foreach ($comment->comment_scores
					->where('user_id', '=', $user_id)
					->find_all() as $score)
				{
					$comments[$i]['score'] = $score->score;
				}				
			}

			$i++;
		}

		return $comments;
	}	
	
	/**
	 * Get the max droplet id in a bucket
	 *
	 * @param int $id ID of the Bucket
	 * @return int
	 */
	public static function get_max_droplet_id($bucket_id = NULL)
	{
		// Build Buckets Query
		$query = DB::select(array(DB::expr('MAX(buckets_droplets.id)'), 'id'))
			->from('buckets_droplets')
			->where('buckets_droplets.bucket_id', '=', $bucket_id);
			
		return $query->execute()->get('id', 0);
	}
	
	/*
	 * Adds a droplet to bucket
	 *
	 * @param int $bucket_id Database ID of the bucket
	 * @param Model_Droplet $droplet Droplet instance to be associated with the river
	 * @return bool TRUE on succeed, FALSE otherwise
	 */
	public static function add_droplet($bucket_id, $droplet)
	{
		if ( ! $droplet instanceof Model_Droplet)
		{
			// Log the error
			Kohana::$log->add(Log::ERROR, "Expected Model_Droplet in parameter droplet. Found :type instead.", 
				array(":type" => gettype($droplet)));
			return FALSE;
		}
		
		// Get ORM reference for the river
		$bucket = ORM::factory('bucket', $bucket_id);
		
		// Check if the river exists and if its associated with the current droplet
		if ($bucket->loaded() AND ! $bucket->has('droplets', $droplet))
		{
			$bucket->add('droplets', $droplet);
			return TRUE;
		}
		
		return FALSE;
	}
	
	/**
	 * Checks if the given user owns the bucket, is an account collaborator
	 * or a bucket collaborator.
	 *
	 * @param int $user_id Database ID of the user	
	 * @return int
	 */
	public function is_owner($user_id)
	{
		// Does the user exist?
		$user_orm = ORM::factory('user', $user_id);
		if ( ! $user_orm->loaded())
		{
			return FALSE;
		}
		
		// Is the user_id the owner?
		if ($this->account->user->id == $user_id)
		{
			return TRUE;
		}
		
				
		// Is the user_id a collaborator
		if ($this->bucket_collaborators->where('user_id', '=', $user_orm->id)->find()->loaded())
		{
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * Gets the no. of users subscribed to the current bucket
	 *
	 * @return int
	 */
	public function get_subscriber_count()
	{
		return $this->subscriptions->count_all();
	}

	/**
	 * Gets the total no. of droplets added to a bucket in each of the last x days
	 * where x is a variable parameter but has a seed value of 30
	 *
	 * @param int $interval
	 * @return array
	 */
	public function get_droplet_activity($interval = 30)
	{
		// Get the interval
		$interval = (empty($interval) AND intval($interval) > 0) 
		    ? 30 
		    : intval($interval);

		// Date arithmetic
		$minus_str = sprintf('-%d day', $interval);
		$start_date = date('Y-m-d H:i:s', strtotime($minus_str, time()));

		// Query to fetch the data
		$query = DB::select(array(DB::expr('DATE_FORMAT(bd.droplet_date_added, "%Y-%m-%d")'), 'droplet_date'),
			array(DB::expr('COUNT(bd.droplet_id)'), 'droplet_count'))
		    ->from(array('droplets', 'd'))
		    ->join(array('buckets_droplets', 'bd'), 'INNER')
		    ->on('bd.droplet_id', '=', 'd.id')
		    ->join(array('buckets', 'b'), 'INNER')
		    ->on('bd.bucket_id', '=', 'b.id')
		    ->where('bd.bucket_id', '=', $this->id)
		    ->where('bd.droplet_date_added', '>=', $start_date)
		    ->group_by('droplet_date')
		    ->order_by('droplet_date', 'ASC');

		// Execute the query and return a row of data
		$rows = $query->execute()->as_array();

		$activity = array();
		foreach ($rows as $row)
		{
			$activity[] = $row['droplet_count'];
		}

		// Return
		return $activity;
	}
	
	/**
	 * Verifies whether the user with the specified id has subscribed
	 * to this river
	 * @return bool
	 */
	public function is_subscriber($user_id)
	{
		return $this->subscriptions
		    ->where('user_id', '=', $user_id)
		    ->find()
		    ->loaded();
	}

}
