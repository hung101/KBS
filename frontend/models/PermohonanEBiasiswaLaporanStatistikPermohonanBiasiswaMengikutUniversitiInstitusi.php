<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

class PermohonanEBiasiswaLaporanStatistikPermohonanBiasiswaMengikutUniversitiInstitusi extends Model
{
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'format' => GeneralLabel::format,

        ];
    }
}
