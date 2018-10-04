<?php

class Task extends DataObject {

    private static $db = [
        'Title' => 'Varchar(255)',
        'InDoing' => 'Boolean',
        'Sort' => 'Int'
    ];

    private static $has_one = [
        "Member" => "Member"
    ];

    protected function onBeforeWrite() {

        if (!$this->Sort) {
            $this->Sort = Member::currentUser()->Tasks()->max('Sort') + 1;
        }

        parent::onBeforeWrite();
    }

    function canView($member = null){
        return true;
    }

    function canCreate($member = null){
        return true;
    }

    function canEdit($member = null){
        return true;
    }

    function canDelete($member = null){
        return true;
    }
}
