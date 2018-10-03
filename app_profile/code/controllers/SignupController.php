<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class SignupController extends Controller {

    public static $url_topic = 'profile';

    public static $url_segment = 'signup';

    private static $allowed_actions = array(
        'index',
        'SignupForm'
    );

    public static $template = 'Page';

    /**
     * Template thats used to render the pages.
     *
     * @var string
     */
    public static $template_main = 'Administration';

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

    }

    /**
     * Show the "index" page
     *
     * @return string Returns the "login" page as HTML code.
     */
    public function index() {

        return $this->customise(new ArrayData(array(
            "Title" => 'Registrieren',
            "Form" => $this->SignupForm()
        )))->renderWith(
            array('Signup_index', 'Signup', $this->stat('template_main'), $this->stat('template'))
        );
    }

    public function SignupForm(){
        return SignupForm::create($this, "SignupForm");
    }
}
