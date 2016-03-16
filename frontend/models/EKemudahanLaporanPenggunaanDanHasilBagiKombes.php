<?php

namespace app\models;

use Yii;
use yii\base\Model;


class EKemudahanLaporanPenggunaanDanHasilBagiKombes extends Model
{
    public $negeri;
    public $kategori;
    public $tarikh_dari;
    public $tarikh_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['negeri', 'kategori', 'tarikh_dari', 'tarikh_hingga'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'negeri' => 'Negeri',
            'kategori' => 'Kategori',
            'tarikh_dari' => 'Tarikh Dari',
            'tarikh_hingga' => 'Hingga',
            'format' => 'Format',
        ];
    }
}
