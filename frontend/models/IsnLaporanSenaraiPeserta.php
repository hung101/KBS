<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanSenaraiPeserta extends Model
{
    public $penganjuran_kursus_id;
    public $format;

    public function rules()
    {
        return [
            [['format', 'penganjuran_kursus_id'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['penganjuran_kursus_id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'penganjuran_kursus_id' => GeneralLabel::kod_kursus,
            'format' => GeneralLabel::format,
        ];
    }
}
