<?php

class BasicUnitTest extends SapphireTest {

    protected static $fixture_file = [
        'app/tests/Group.yml',
        'app/tests/Permission.yml',
        'app/tests/Member.yml',
        'app/tests/Task.yml'
    ];


    /**
     * Basic Test
     */
    public function testBasic() {
        $Tasks = Task::get();
        $this->assertEquals(2, $Tasks->count());
    }
}
