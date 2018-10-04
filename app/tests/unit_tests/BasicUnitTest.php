<?php

class BasicUnitTest extends SapphireTest {

    protected static $fixture_file = [
      'app_fixtures/Group.yml',
      'app_fixtures/Permission.yml',
      'app_fixtures/Member.yml',
      'app_fixtures/Task.yml'
    ];


    /**
     * Basic Test
     */
    public function testBasic() {
        $Tasks = Task::get();
        $this->assertEquals(2, $Tasks->count());
    }
}
