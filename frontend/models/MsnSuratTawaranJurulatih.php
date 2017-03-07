<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnSuratTawaranJurulatih extends Model
{
    public $tarikh;
    public $tarikh_luput;
    public $bil_msnm;
    public $jurulatih_id;
    public $format;
    public $bahasa;

    public function rules()
    {
        return [
            [['format', 'jurulatih_id', 'tarikh', 'bil_msnm', 'bahasa'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'bil_msnm', 'jurulatih_id', 'tarikh_luput', 'bahasa'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'bil_msnm' => "Bil MSNM",
            'jurulatih_id' => GeneralLabel::jurulatih,
            'tarikh_luput' => GeneralLabel::tarikh_luput,
            'format' => GeneralLabel::format,
            'bahasa' => GeneralLabel::bahasa
        ];
    }
}
