<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class PjsLaporanAhliJawatankuasaInduk extends Model
{
    public $bangsa;
    public $jantina;
    public $umur_dari;
    public $umur_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['bangsa', 'jantina', 'umur_dari', 'umur_hingga'], 'safe'],
            [['umur_dari', 'umur_hingga'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['umur_hingga'], 'compare', 'compareAttribute'=>'umur_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
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
