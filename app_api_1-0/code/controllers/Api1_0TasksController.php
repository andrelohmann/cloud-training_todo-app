<?php

use Ntb\RestAPI\BaseRestController;
use Ntb\RestAPI\RestUserException;

/**
 *
 * @author Andre Lohmann <lohmann.andre@gmail.com>
 */
class Api1_0TasksController extends BaseRestController {

    private static $allowed_actions = array (
        'get' => '->isAuthenticated',
        'post' => '->isAuthenticated',
        'delete' => '->isAuthenticated',
        'put' => '->isAuthenticated'
    );

    public function get($request) {
        $tasks = Task::get()->filter('MemberID', $this->currentUser()->ID)->Sort('Sort');
        $meta = [
            'timestamp' => time()
        ];
        // check param for id
        if($id = $request->param('ID')) {
            $task = $tasks->byID($id);
            if(!$task) {
                throw new RestUserException("Task with id $id not found", 400);
            }
            $data = [
                'task' => Api1_0TaskFormatter::format($task)
            ];
        } else {
            $limit = $this->limit($request);
            $offset = $this->offset($request);
            $data = [
                'tasks' => array_map(function($task) {
                    return Api1_0TaskFormatter::format($task);
                }, $tasks->limit($limit, $offset)->Sort('Sort')->toArray())
            ];

            $meta['count'] = $tasks->Count();
            $meta['offset'] = $offset;
            $meta['limit'] = $limit;
        }
        $data['meta'] = $meta;
        return $data;
    }

    /**
     * @param SS_HTTPRequest $request
     * @return array
     * @throws RestUserException
     */
    public function post($request) {
      $tasks = Task::get()->filter('MemberID', $this->currentUser()->ID)->Sort('Sort');
      $meta = [
          'timestamp' => time()
      ];
      // check data
      $data = json_decode($request->getBody(), true);
      if(!$data) {
          throw new RestUserException("No data for task provided.", 404, 404);
      }
      try{
          $validatedData = Api1_0TaskValidator::validate($data);
          $task = Task::create();
          $task->Title = $validatedData['Title'];
          $task->MemberID = $this->currentUser()->ID;
          $task->write();

      } catch(ValidationException $e) {
          throw new RestUserException($e->getMessage(), 404, 404);
      } catch(Exception $e) {
          throw new RestUserException($e->getMessage(), 404, 404);
      }
      $meta['count'] = $tasks->Count();
      $result = [
          'task' => Api1_0TaskFormatter::format($task)
      ];
      $result['meta'] = $meta;
      return $result;

    }

    /**
     * @param SS_HTTPRequest $request
     * @return array
     * @throws RestUserException
     */
    public function delete($request) {
      $tasks = Task::get()->filter('MemberID', $this->currentUser()->ID)->Sort('Sort');
      $meta = [
          'timestamp' => time()
      ];
      // check param for id
      if($id = $request->param('ID')) {
          /** @var Task $task */
          $task = $tasks->byID($id);
          if(!$task) {
              throw new RestUserException("Task with id $id not found", 404, 404);
          }
          $data = [
              'task' => Api1_0TaskFormatter::format($task)
          ];
          $task->delete();
      } else {
          throw new RestUserException("No id specified for deletion of task", 4041, 404);
      }
      $meta['count'] = $tasks->Count();
      $data['meta'] = $meta;
      return $data;

    }

    /**
     * @param SS_HTTPRequest $request
     * @return array
     * @throws RestUserException
     */
    public function put($request) {
        $tasks = Task::get()->filter('MemberID', $this->currentUser()->ID)->Sort('Sort');
        $meta = [
            'timestamp' => time()
        ];
        // check data
        $data = json_decode($request->getBody(), true);
        if(!$data) {
            throw new RestUserException("No data for task provided.", 404, 404);
        }
        // check param for id
        $id = $request->param('ID');
        if(!$id) {
            throw new RestUserException("No id for task provided.", 404, 404);
        }
        // fetch specified task
        /** @var Task $task */
        $task = $tasks->byID($id);
        if (!$task) {
            throw new RestUserException("Task with id $id not found", 404, 404);
        }
        try {
            $validatedData = Api1_0TaskValidator::validate($data['task']);
            $task->Title = $validatedData['Title'];
            $task->write();

            $meta['count'] = $tasks->Count();

            $result = [
                'task' => Api1_0TaskFormatter::format($task),
                'meta' => $meta
            ];
            return $result;
        } catch(ValidationException $e) {
            throw new RestUserException($e->getMessage(), 404, 404);
        }

    }

}
