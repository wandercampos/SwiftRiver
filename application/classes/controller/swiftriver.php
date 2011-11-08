<?php defined('SYSPATH') OR die('No direct access allowed.');

/**
 * Swiftriver Base controller
 *
 * PHP version 5
 * LICENSE: This source file is subject to GPLv3 license 
 * that is available through the world-wide-web at the following URI:
 * http://www.gnu.org/copyleft/gpl.html
 * @author     Ushahidi Team <team@ushahidi.com> 
 * @package    Ushahidi - http://source.swiftly.org
 * @category Controllers
 * @copyright  Ushahidi - http://www.ushahidi.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU General Public License v3 (GPLv3) 
 */
class Controller_Swiftriver extends Controller_Template {
	
	/**
	 * @var boolean Whether the template file should be rendered automatically.
	 */
	public $auto_render = TRUE;
	
	/**
	 * @var string Filename of the template file.
	 */
	public $template = 'template/layout';
	
	/**
	 * Controls access for the controller and sub controllers, if not set to FALSE we will only allow user roles specified
	 *
	 * Can be set to a string or an array, for example array('editor', 'admin') or 'login'
	 */
	public $auth_required = FALSE;
	
	/**
	 * Active River
	 * If set, we should redirect to this river by default, otherwise remain on dashboard
	 * @var int ID of the current river
	 */
	public $active_river = NULL;

	/**
	 * Logged In User
	 */
	public $user = NULL;

	/**
	 * Current Users Account
	 */
	public $account = NULL;

	/**
	 * This Session
	 */
	protected $session;
	
	/**
	 * Called from before() when the user is not logged in but they should.
	 *
	 * Override this in your own Controller / Controller_App.
	 */
	public function login_required()
	{
		Request::current()->redirect('welcome');
	}

	/**
	 * Called from before() when the user does not have the correct rights to access a controller/action.
	 * This is the users personal dashboard
	 *
	 */
	public function access_required()
	{
		Request::current()->redirect('dashboard');
	}	
	
	/**
	 * The before() method is called before main controller action.
	 * In our template controller we override this method so that we can
	 * set up default values. These variables are then available to our
	 * controllers if they need to be modified.
	 *
	 * @return	void
	 */
	public function before()
	{
		try
		{
			$this->session = Session::instance();
		}
		catch (ErrorException $e)
		{
			session_destroy();
		}
		
		// Execute parent::before first
		parent::before();
		// Open session
		$this->session = Session::instance();
		
		//if we're not logged in, gives us chance to auto login
		$supports_auto_login = new ReflectionClass(get_class(Auth::instance()));
		$supports_auto_login = $supports_auto_login->hasMethod('auto_login');
		if( ! Auth::instance()->logged_in() AND $supports_auto_login)
		{
			Auth::instance()->auto_login();
			if ( ! Auth::instance()->get_user() )
			{
				$this->login_required();
			}
		}

		if 
		(
			// auth is required AND user role given in auth_required is NOT logged in
			$this->auth_required !== FALSE AND 
				Auth::instance()->logged_in($this->auth_required) === FALSE
		)
		{
			if (Auth::instance()->logged_in())
			{
				// user is logged in but not on the secure_actions list
				$this->access_required();
			}
			else
			{
				$this->login_required();
			}
		}

		// Logged In User
		$this->user = Auth::instance()->get_user();

		// Does this user have an account space?
		$this->account = ORM::factory('account')
			->where('user_id', '=', $this->user->id)
			->find();
			
		if ( ! $this->account->loaded())
		{
			// Redirect?
		}	
		
		// Load Header & Footer & variables
		$this->template->header = View::factory('template/header');
		$this->template->header->user = $this->user;
		$this->template->header->account = $this->account;
		$this->template->header->js = ''; // Dynamic Javascript

		// Navs
		$this->template->header->nav_header = View::factory('template/nav/header');
		$this->template->header->nav_header->rivers = $this->account->rivers->find_all();
		$this->template->header->nav_header->buckets = $this->account->buckets->find_all();
		$this->template->header->nav_canvas = View::factory('template/nav/canvas');
		$this->template->header->nav_canvas->filters = url::site().$this->account->account_path.'/river/filters/';
		$this->template->header->nav_canvas->channels = url::site().$this->account->account_path.'/river/channels/';

		$this->template->content = '';
		$this->template->footer = View::factory('template/footer');
	}
	

	/**
	 * @return	void
	 */
	public function action_index()
	{
		$this->request->redirect($this->account->account_path.'/river');
	}
}
