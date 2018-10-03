<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class PasswordAdminController extends Controller {

    public static $url_topic = 'profile';

    public static $url_segment = 'passwordadmin';

    private static $allowed_actions = array(
        'index',
        'PasswordEditForm'
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

        if(!Member::currentUser()) return $this->redirect('Security/login?BackURL=passwordadmin/index');
    }

    /**
     * Show the "index" page
     *
     * @return string Returns the "login" page as HTML code.
     */
    public function index() {

        return $this->customise(new ArrayData(array(
            "Title" => 'Passwort ändern',
            "Form" => $this->PasswordEditForm()
        )))->renderWith(
            array('PasswordAdmin_index', 'PasswordAdmin', $this->stat('template_main'), $this->stat('template'))
        );
    }

    public function PasswordEditForm(){
        return PasswordEditForm::create($this, "PasswordEditForm");
    }
}