<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;


class EKemudahanLaporanPenggunaanDanHasilBagiKombesTahunan extends Model
{
    public $tahun_1;
    public $tahun_2;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun_1', 'tahun_2'], 'required'],
            [['tahun_1', 'tahun_2'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax],
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
