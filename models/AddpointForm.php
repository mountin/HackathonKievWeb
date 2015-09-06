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

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, address, type are required
            [['name', 'address', 'type'], 'required'],
            [['type'], 'string'],
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
            'type' => 'Тип',
            'phone' => 'Телефон',
            'address' => 'Адреса',
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

            $pointData = [
                'name' => $this->name,
                'longitude' => $this->longitude,
                'latitude' => $this->latitude,
                'type' => $this->type,
                'phone' => $this->phone,
                'address' => $this->address,
                'comment' => $this->comment
            ];

            echo 1111111111111;
            echo '<pre>';
            print_r($pointData);
            echo '</pre>';

            return $pointData;
        }

        return false;
    }
}
