<?php

namespace app\models;

use Yii;
use yii\base\Model;


class PermohonanEBantuanLaporanStatusPermohonanBantuan extends Model
{

    public $jumlah_dilulus_dari;
    public $jumlah_dilulus_hingga;
    public $jumlah_dipohon_dari;
    public $jumlah_dipohon_hingga;
    public $negeri;
    public $tarikh_terima_dari;
    public $tarikh_terima_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['jumlah_dilulus_dari', 'jumlah_dilulus_hingga', 'jumlah_dipohon_dari', 'jumlah_dipohon_hingga', 'negeri', 'tarikh_terima_dari', 'tarikh_terima_hingga'], 'safe'],
            [['jumlah_dilulus_dari', 'jumlah_dilulus_hingga', 'jumlah_dipohon_dari', 'jumlah_dipohon_hingga'], 'number'],
            [['tarikh_terima_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'jumlah_dilulus_dari' => 'Jumlah Dilulus Dari',
            'jumlah_dilulus_hingga' => 'Hingga',
            'jumlah_dipohon_dari' => 'Jumlah Dipohon Dari',
            'jumlah_dipohon_hingga' => 'Hingga',
            'negeri' => 'Negeri',
            'tarikh_terima_dari' => 'Tarikh Terima Dari',
            'tarikh_terima_hingga' => 'Hingga',
            'format' => 'Format',
        ];
    }
}
