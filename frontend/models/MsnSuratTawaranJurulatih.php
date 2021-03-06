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
    public $jurulatih_status_desc;
    public $format;
    public $bahasa;

    public function rules()
    {
        return [
            [['format', 'jurulatih_id', 'bil_msnm', 'bahasa'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'bil_msnm', 'jurulatih_id', 'tarikh_luput', 'bahasa', 'tarikh', 'jurulatih_status_desc'], 'safe'],
            [['tarikh', 'bil_msnm', 'jurulatih_status_desc'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'bil_msnm' => "Rujukan MSN",
            'jurulatih_id' => GeneralLabel::jurulatih,
            'tarikh_luput' => GeneralLabel::tarikh_luput,
            'format' => GeneralLabel::format,
            'bahasa' => GeneralLabel::bahasa
        ];
    }
}
