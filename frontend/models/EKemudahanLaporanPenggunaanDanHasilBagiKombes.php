<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;


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
            'negeri' => GeneralLabel::negeri,
            'kategori' => GeneralLabel::kategori,
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'format' => GeneralLabel::format,

        ];
    }
}
