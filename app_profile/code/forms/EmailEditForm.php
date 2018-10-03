<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class EmailEditForm extends BootstrapHorizontalForm {

    public function __construct($controller, $name, $fields = null, $actions = null) {

        $fields = new FieldList(
            EmailField::create('Email')->setTitle('Email')
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
                "Email"
            )
        );

        if(Member::currentUser()) $this->loadDataFrom(Member::currentUser());
    }

    public function doEdit(array $data) {

        if($Member = Member::get()->filter(array("Email" => $data['Email']))->exclude(array('ID' => Member::currentUserID()))->first()){
            $this->addErrorMessage('Email', 'Es existiert bereits ein Account mit der angegebenen Email-Adresse', 'bad');
            $this->controller->redirectBack();
            return false;
        }

        if($Member = Member::currentUser()){

            $this->saveInto($Member);

            $Member->write();

            $this->sessionMessage('Änderung gespeichert', 'good');
        }

        $this->controller->redirect('emailadmin/index');
    }
}