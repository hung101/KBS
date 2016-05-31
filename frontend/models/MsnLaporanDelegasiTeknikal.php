<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanDelegasiTeknikal extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $temasya;
    public $sukan;
    public $peringkat;
    public $nama_badan_sukan;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'temasya', 'sukan', 'peringkat', 'nama_badan_sukan'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'temasya' => GeneralLabel::temasya,
            'sukan' => GeneralLabel::sukan,
            'peringkat' => GeneralLabel::peringkat,
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan,
            'format' => GeneralLabel::format,
        ];
    }
}
