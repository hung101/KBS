<?php

namespace app\models;

use Yii;
use yii\base\Model;


class PjsLaporanAhliJawatankuasaKeceilBiro extends Model
{
    public $bangsa;
    public $jantina;
    public $umur_dari;
    public $umur_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['bangsa', 'jantina', 'umur_dari', 'umur_hingga'], 'safe'],
            [['umur_dari', 'umur_hingga'], 'number'],
            [['umur_hingga'], 'compare', 'compareAttribute'=>'umur_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'bangsa' => 'Bangsa',
            'jantina' => 'Jantina',
            'umur_dari' => 'Umur Dari',
            'umur_hingga' => 'Hingga',
            'format' => 'Format',
        ];
    }
}
