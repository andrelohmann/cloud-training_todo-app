<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class TaskAddForm extends BootstrapHorizontalForm {

    public function __construct($controller, $name, $fields = null, $actions = null) {

        $fields = new FieldList(
            TextField::create('Title')->setTitle('Todo')
        );

        $actions = new FieldList(
            $Submit = BootstrapLoadingFormAction::create('doAdd')->setButtonContent('<span class="glyphicon glyphicon-plus"></span>')
        );
        $Submit->addExtraClass('btn-success');
        $Submit->setUseButtonTag(true)->setDescription('Hinzufügen');

        parent::__construct(
            $controller,
            $name,
            $fields,
            $actions,
            new RequiredFields(
              "Title"
            )
        );
    }

    public function doAdd(array $data) {

      $Task = new Task();

      $this->saveInto($Task);

      $Task->MemberID = Member::currentUserID();

      $Task->write();

      BootstrapFlashMessage::set("Task \"".$Task->Title."\" hinzugefügt", 'success');

      return $this->controller->redirect('tasklist/index');
    }
}
