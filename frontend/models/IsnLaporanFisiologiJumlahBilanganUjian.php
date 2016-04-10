<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanFisiologiJumlahBilanganUjian extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $sukan;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['tarikh_dari', 'tarikh_hingga', 'sukan'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'sukan' => GeneralLabel::sukan,
            'format' => GeneralLabel::format,
        ];
    }
}
