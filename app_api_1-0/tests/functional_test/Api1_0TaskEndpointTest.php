<?php
use Ntb\APIBasicAuth\RestTest;

/**
 * Class TaskEndpointTest
 */
class Api1_0TaskEndpointTest extends RestTest {

    public function setUp() {
        parent::setUp();
        // Do your stuff here
    }

    public function tearDown() {
        parent::setUp();
        // Do your stuff here
    }

    protected static $fixture_file = [
      'app_fixtures/Group.yml',
      'app_fixtures/Permission.yml',
      'app_fixtures/Member.yml',
      'app_fixtures/Task.yml'
    ];

    public function testGetTasks() {

      // create Session
      $session = $this->createSession('user@todo.lokal', 'p');

      $result = $this->makeApiRequest('api/1.0/tasks', ['method' => 'GET', 'token' => $session['token']]);
      $tasks = $result['tasks'];
      $this->assertEquals(2, $result['meta']['count']);
      $this->assertEquals(2, count($result['tasks']));
   }

   public function testCreateTask() {

     $data = [
         'title' => 'Lorem ipsum'
     ];
     // create Session
     $session = $this->createSession('user@todo.lokal', 'p');

     $result = $this->makeApiRequest('api/1.0/tasks', ['method' => 'POST', 'body' => json_encode($data), 'token' => $session['token']]);
     $task = $result['task'];
     $this->assertEquals(3, $result['meta']['count']);
     $this->assertTrue(is_array($task));
     $this->assertTrue(array_key_exists('id', $task));
     $this->assertEquals(3, $task['id']);
     $this->assertTrue(array_key_exists('in_doing', $task));
     $this->assertFalse($task['in_doing']);
     $this->assertTrue(array_key_exists('title', $task));
     $this->assertEquals('Lorem ipsum', $task['title']);
  }
}
