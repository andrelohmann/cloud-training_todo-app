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
        'TaskAddForm',
        'toggle',
        'delete'
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

        // in alphabetical order
        $t = Task::get()->filter('MemberID', Member::currentUserID())->sort('Sort');
        $Tasks = new OrderablePaginatedList($t, $this->request);
        $Tasks->setPageLength(10);

        Requirements::block('bootstrap_orderable_frontend/javascript/OrderablePaginatedList.js');
        Requirements::javascript('app/javascript/OrderablePaginatedList.js');

        if($this->request->isAjax()) {
            return $this->customise(array(
                "Tasks" => $Tasks->process(),
                "URL" => $this->request->getURL(true)
            ))->renderWith('TasksList');
        }

        return $this->customise(new ArrayData(array(
            "Title" => 'Todos',
            "Tasks" => $Tasks,
            "URL" => $this->request->getURL(true),
            "Form" => $this->TaskAddForm()
        )))->renderWith(
            array('Tasklist_index', 'Tasklist', $this->stat('template_main'), $this->stat('template'))
        );
    }

    public function TaskAddForm(){
        return TaskAddForm::create($this, "TaskAddForm");
    }

    /**
     * delete the application
     */
    public function delete() {

        if($Task = Task::get()->filter('MemberID', Member::currentUserID())->byID($this->request->param('ID'))) {
            $Task->delete();
            BootstrapFlashMessage::set(sprintf('Das folgende Todo wurde gelöscht:<br />%s', $Task->Title), 'warning');
        }

        return $this->redirectBack();
    }

    /**
     * toggle the agency
     */
    public function toggle() {

        if($Task = Task::get()->filter('MemberID', Member::currentUserID())->byID($this->request->param('ID'))) {
            if(!$Task->InDoing){
                $Task->InDoing = true;
                BootstrapFlashMessage::set('Das Todo ist in Bearbeitung', 'success');
            }else{
                $Task->InDoing = false;
                BootstrapFlashMessage::set('Das Todo ist nicht mehr in Bearbeitung', 'warning');
            }
            $Task->write();
        }

        return $this->redirectBack();
    }
}
