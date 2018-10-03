<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PasswordEditForm extends BootstrapHorizontalForm {

    public function __construct($controller, $name, $fields = null, $actions = null) {

        $fields = new FieldList(
            //ReadonlyField::create('FirstName')->setTitle('Vorname'),
            //ReadonlyField::create('Surname')->setTitle('Nachname'),
            ReadonlyField::create('Email')->setTitle('Email'),
            $Password = new BootstrapConfirmedPasswordField(
                'Password',
                'Passwort'
            )
        );

        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doEdit')->setButtonContent('<span class="glyphicon glyphicon-floppy-save"></span>')
        );
        $Submit->addExtraClass('btn-success');
        $Submit->setUseButtonTag(true)->setDescription('Speichern');

        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
                "Password"
            )
        );

        if(Member::currentUser()) $this->loadDataFrom(Member::currentUser());
    }

    public function doEdit(array $data) {

        if($Member = Member::currentUser()){
            
            $this->saveInto($Member);

            $Member->Changed = true;
            $Member->write();

            $this->sessionMessage('Änderung gespeichert', 'good');
        }

        $this->controller->redirect('passwordadmin/index');
    }
}