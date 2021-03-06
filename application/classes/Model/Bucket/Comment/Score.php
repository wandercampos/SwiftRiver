<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Model for Model_Comment_Score
 *
 * PHP version 5
 * LICENSE: This source file is subject to the AGPL license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/licenses/agpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    SwiftRiver - https://github.com/ushahidi/SwiftRiver
 * @subpackage Models
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/licenses/agpl.html GNU Affero General Public License (AGPL)
 */
class Model_Bucket_Comment_Score extends ORM {
	
	protected $_belongs_to = array(
		'bucket_comment' => array(),
		'user' => array()
	);
	
	
	/**
	 * Auto-update columns for creation
	 * @var string
	 */
    protected $_created_column = array('column' => 'score_date_add', 'format' => 'Y-m-d H:i:s');
	
	/**
	 * Auto-update columns for updates
	 * @var string
	 */
    protected $_updated_column = array('column' => 'score_date_modified', 'format' => 'Y-m-d H:i:s');

}
?>