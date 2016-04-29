<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanBulananProgramPendidikan extends Model
{
    public $tahun;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tahun'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
        ];
    }

    public function attributeLabels()
    {
        return [
            'negeri' => GeneralLabel::negeri,
            'kategori' => GeneralLabel::kategori,
            'tahun' => GeneralLabel::tahun,
            'format' => GeneralLabel::format,

        ];
    }
}
