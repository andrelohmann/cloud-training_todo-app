<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailEditForm extends BootstrapHorizontalForm {

    public function __construct($controller, $name, $fields = null, $actions = null) {

        $fields = new FieldList(
            EmailField::create('Email')->setTitle('Email'),
            $Password = new BootstrapConfirmedPasswordField(
                'Password',
                'Passwort'
            )
        );

        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doSignup')->setButtonContent('<span class="glyphicon glyphicon-floppy-save"></span>')
        );
        $Submit->addExtraClass('btn-success');
        $Submit->setUseButtonTag(true)->setDescription('Registrieren');

        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredUniqueFields(
              $required = [
                "Email",
                "Password"
              ], $unique = [
                  "Email" => "Die Emailadresse ist bereits in Benutzung"
              ], $objectClass = 'Member'
            )
        );
    }

    public function doSignup(array $data) {

      $Member = new Member();

      $this->saveInto($Member);

      $Member->write();

      $Member->logIn();

      BootstrapFlashMessage::set("Registrierung abgeschlossen", 'success');

      return $this->controller->redirect('tasklist/index');
    }
}
