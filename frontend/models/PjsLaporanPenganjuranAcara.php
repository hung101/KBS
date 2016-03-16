<?php

namespace app\models;

use Yii;
use yii\base\Model;


class PjsLaporanPenganjuranAcara extends Model
{
    public $peringkat;
    public $tarikh_dari;
    public $tarikh_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['tarikh_dari', 'tarikh_hingga', 'peringkat'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'peringkat' => 'Peringkat',
            'tarikh_dari' => 'Tarikh Dari',
            'tarikh_hingga' => 'Hingga',
            'format' => 'Format',
        ];
    }
}
