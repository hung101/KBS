<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;


class EKemudahanLaporanPenggunaanDanHasilBagiKombesTahunan extends Model
{
    public $tahun_1;
    public $tahun_2;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun_1', 'tahun_2'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tahun_1', 'tahun_2'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
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
