<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnSuratTawaranAtlet extends Model
{
    public $tarikh;
    public $tarikh_luput;
    public $bil_msnm;
    public $atlet_id;
    public $gaji_dan_elaun_jurulatih_id;
    public $format;

    public function rules()
    {
        return [
            [['format', 'atlet_id', 'gaji_dan_elaun_jurulatih_id'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'bil_msnm', 'atlet_id', 'tarikh_luput'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'bil_msnm' => "Bil MSNM",
            'atlet_id' => GeneralLabel::atlet,
            'tarikh_luput' => GeneralLabel::tarikh_luput,
            'format' => GeneralLabel::format,
        ];
    }
}
