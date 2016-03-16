<?php

namespace app\models;

use Yii;
use yii\base\Model;


class PermohonanEBiasiswaLaporanSenaraiPenerimaBiasiswa extends Model
{
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'format' => 'Format',
        ];
    }
}
