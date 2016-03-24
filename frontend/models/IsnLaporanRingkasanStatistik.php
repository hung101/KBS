<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;


class IsnLaporanRingkasanStatistik extends Model
{
    public $tahun;
    public $format;

    public function rules()
    {
        return [
            [['format','tahun'], 'required'],
            [['tahun'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax],
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
