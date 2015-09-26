<?php

namespace app\models;

use Yii;
use yii\base\Model;

use linslin\yii2\curl;

/**
 * ContactForm is the model behind the contact form.
 */
class AddpointForm extends Model
{
    public $name;
    public $status;
    public $longitude;
    public $latitude;
    public $type;
    public $phone;
    public $address;
    public $comment;
    public $images;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, address, type are required
            [['name', 'address', 'type'], 'required'],
            [['type', 'images'], 'string'],
            [['longitude', 'latitude', 'status', 'phone', 'comment'], 'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Назва',
            //'longitude' => ''
            //'latitude' => ''
            'type' => 'Тип сировини',
            'phone' => 'Телефон',
            'address' => 'Адреса пункту прийому сировини',
            'comment' => 'Коментарі',
        ];
    }

    public static function getTypeAttribute()
    {
        return [
            'Батарейки',
            'Скло'
        ];
    }

    public function validateData()
    {
        if ($this->validate()) {

            $lng = !empty($this->address) ? $this->getLatLngFromAddress($this->address) : 20.00000;
            $lat = !empty($this->address) ? $this->getLatLngFromAddress($this->address) : 50.00000;

            $pointData = [
                'name' => $this->name,
                'address' => $this->address,
                'longitude' => $lng['lng'],
                'latitude' => $lat['lat'],
                'type' => $this->type,
                'phone' => $this->phone,
                'comment' => $this->comment
            ];

            return $pointData;
        }

        return false;
    }

    /**
     * @param string $address
     * @return array
     */
    public function getLatLngFromAddress($address)
    {
        $result = [];
        $prepareAddress = str_replace(' ', '+', $address);

        $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $prepareAddress . '&sensor=false');
        $output = json_decode($geocode);

        $result['lat'] = $output->results[0]->geometry->location->lat;
        $result['lng'] = $output->results[0]->geometry->location->lng;
        return  $result;
    }
}
