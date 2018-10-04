<?php

class BasicFunctionalTest extends FunctionalTest {

    protected static $fixture_file = [
        'app_fixtures/Group.yml',
        'app_fixtures/Permission.yml',
        'app_fixtures/Member.yml',
        'app_fixtures/Task.yml'
    ];

    /**
     * Test generation of the view
     */
    public function testRoot() {
        $page = $this->get('/');

        // Home page should load..
        $this->assertEquals(200, $page->getStatusCode());

        // We should see a login form
        //$login = $this->submitForm("LoginFormID", null, array(
        //    'Email' => 'test@test.com',
        //    'Password' => 'wrongpassword'
        //));

        // wrong details, should now see an error message
        //$this->assertExactHTMLMatchBySelector("#LoginForm p.error", array(
        //    "That email address is invalid."
        //));

        // If we login as a user we should see a welcome message
        //$me = Member::get()->first();

        //$this->logInAs($me);
        //$page = $this->get('home/');

        //$this->assertExactHTMLMatchBySelector("#Welcome", array(
        //    'Welcome Back'
        //));
    }
}
