<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class HomeController extends Controller {

	public static $url_topic = 'home';

	public static $url_segment = 'home';

	private static $allowed_actions = array(
		'index'
	);

	public static $template = 'BlankPage';

	/**
	 * Template thats used to render the pages.
	 *
	 * @var string
	 */
	public static $template_main = 'Page';

	/**
	 * Returns a link to this controller.  Overload with your own Link rules if they exist.
	 */
	public function Link() {
		return self::$url_segment .'/';
	}

	/**
	 * Initialise the controller
	 */
	public function init() {

		parent::init();

		if(Member::currentUser()) return $this->redirect('tasklist/index');
    else return $this->redirect('Security/login?BackURL=tasklist/index');

 	}

	/**
	 * Show the "login" page
	 *
	 * @return string Returns the "login" page as HTML code.
	 */
	public function index() {
    return false;
  }
}
