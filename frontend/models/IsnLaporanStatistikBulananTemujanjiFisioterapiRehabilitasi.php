<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanStatistikBulananTemujanjiFisioterapiRehabilitasi extends Model
{
    public $tahun;
    public $kategori_program_id;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['kategori_program_id'], 'safe'],
            [['tahun'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kategori_program_id' => GeneralLabel::kategori_program,
            'tahun' => GeneralLabel::tahun,
            'format' => GeneralLabel::format,

        ];
    }
}
