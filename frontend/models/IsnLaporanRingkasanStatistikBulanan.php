<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanRingkasanStatistikBulanan extends Model
{
    public $tahun;
    public $kategori_program_id;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun'], 'required'],
            [['kategori_program_id'], 'safe'],
            [['tahun'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax],
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
