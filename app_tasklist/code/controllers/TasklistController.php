<?php
/**
 * Implements a basic Controller
 * @package some config
 * http://doc.silverstripe.org/framework/en/3.1/topics/controller
 */
class TasklistController extends Controller {

    public static $url_topic = 'tasklist';

    public static $url_segment = 'tasklist';

    private static $allowed_actions = array(
        'index',
        'TaskAddForm'
    );

    public static $template = 'Page';

    /**
     * Template thats used to render the pages.
     *
     * @var string
     */
    public static $template_main = 'Tasklist';

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

        if(!Member::currentUser()) return $this->redirect('Security/login?BackURL=tasklist/index');
    }

    /**
     * Show the "index" page
     *
     * @return string Returns the "login" page as HTML code.
     */
    public function index() {

        return $this->customise(new ArrayData(array(
            "Title" => 'Todos',
            "Form" => $this->TaskAddForm()
        )))->renderWith(
            array('Tasklist_index', 'Tasklist', $this->stat('template_main'), $this->stat('template'))
        );
    }

    public function TaskAddForm(){
        return TaskAddForm::create($this, "TaskAddForm");
    }
}
