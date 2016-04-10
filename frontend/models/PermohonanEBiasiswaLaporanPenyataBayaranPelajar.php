<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class PermohonanEBiasiswaLaporanPenyataBayaranPelajar extends Model
{
    public $e_biasiswa_id;
    public $format;

    public function rules()
    {
        return [
            [['format', 'e_biasiswa_id'], 'required'],
            [['e_biasiswa_id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'e_biasiswa_id' => GeneralLabel::e_biasiswa_id,
            'format' => GeneralLabel::format,

        ];
    }
}
