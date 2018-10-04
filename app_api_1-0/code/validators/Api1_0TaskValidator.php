<?php
use Ntb\RestAPI\IRestValidator;
use Ntb\RestAPI\RestValidatorHelper;

/**
 * Class TaskValidator
 * @author Andre Lohmann <lohmann.andre@gmail.com>
 */
class Api1_0TaskValidator implements IRestValidator {
    const MaxTitleLength = 255;


    public static function validate($data) {
        // check title
        $title = RestValidatorHelper::validate_string($data, 'title', ['max' => self::MaxTitleLength, 'required' => true]);
        return [
            'Title' => $title
        ];
    }

}
