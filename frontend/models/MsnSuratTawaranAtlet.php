<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnSuratTawaranAtlet extends Model
{
    public $tarikh;
    public $bil_msnm;
    public $atlet_id;
    public $format;

    public function rules()
    {
        return [
            [['format', 'atlet_id'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'bil_msnm', 'atlet_id'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'bil_msnm' => "Bil MSNM",
            'atlet_id' => GeneralLabel::atlet,
            'format' => GeneralLabel::format,
        ];
    }
}
