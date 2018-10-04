<?php
use Ntb\RestAPI\IRestSerializeFormatter;

/**
 * Class Api1_0TaskFormatter
 * @author Andre Lohmann <lohmann.andre@gmail.com>
 */
class Api1_0TaskFormatter implements IRestSerializeFormatter {

    /**
     * @param Ntb\Tag $data
     * @param array $access
     * @param array $fields
     * @return array
     */
    public static function format($data, $access=null, $fields=null) {

        return [
            'id' => $data->ID,
            'title' => $data->Title,
            'in_doing' => (bool)$data->InDoing
        ];
    }
}
