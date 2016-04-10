<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

class PjsLaporanAhliJawatankuasaKecilBiro extends Model
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
            'bangsa' => GeneralLabel::bangsa,
            'jantina' => GeneralLabel::jantina,
            'umur_dari' => GeneralLabel::umur_dari,
            'umur_hingga' => GeneralLabel::umur_hingga,
            'format' => GeneralLabel::format,

        ];
    }
}
