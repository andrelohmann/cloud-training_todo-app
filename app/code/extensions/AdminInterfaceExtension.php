<?php
/**
 * Created by PhpStorm.
 * User: andrelohmann
 * Date: 12.04.16
 * Time: 20:48
 */
class AdminInterfaceExtension extends LeftAndMainExtension {

    public function init() {
        parent::init();
        CMSMenu::remove_menu_item('SecurityAdmin');
        CMSMenu::remove_menu_item('CMSSettingsController');
    }

}