<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanStatistikJus extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $jenis_jus;
    public $nama_jus;
    public $sukan;
    public $atlet;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'jenis_jus', 'nama_jus', 'sukan', 'atlet'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'format' => GeneralLabel::format,
            'jenis_jus' => GeneralLabel::jenis_jus,
            'nama_jus' => GeneralLabel::nama_jus,
            'sukan' => GeneralLabel::sukan,
            'atlet' => GeneralLabel::atlet,
        ];
    }
}
