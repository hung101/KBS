<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanJadualPegawaiTemujanji extends Model
{
    public $tarikh;
    public $tarikh_dari;
    public $tarikh_hingga;
    public $pegawai_bertanggungjawab;
    public $sukan;
    public $bahagian_kecederaan;
    public $atlet;
    public $rawatan;
    public $status_temujanji;
    public $kategori_rawatan;
    
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh' ,'tarikh_dari', 'tarikh_hingga', 'pegawai_bertanggungjawab', 'sukan', 'bahagian_kecederaan', 'atlet', 'rawatan', 'status_temujanji', 'kategori_rawatan'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh' => GeneralLabel::tarikh,
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'pegawai_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'sukan' => GeneralLabel::sukan,
            'bahagian_kecederaan' => GeneralLabel::bahagian_kecederaan,
            'atlet' => GeneralLabel::atlet,
            'rawatan' => GeneralLabel::rawatan,
            'status_temujanji' => GeneralLabel::status_temujanji,
            'kategori_rawatan' => GeneralLabel::kategori_rawatan,
            'format' => GeneralLabel::format,
        ];
    }
}
