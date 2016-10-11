<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanKomplimentori extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $bahagian_kecederaan;
    public $pegawai_bertanggungjawab;
    public $sukan;
    public $jantina;
    public $perkhidmatan;
    public $lokasi;
    public $status_temujanji;
    public $atlet;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'pegawai_bertanggungjawab', 'sukan', 'bahagian_kecederaan', 'jantina', 'perkhidmatan','lokasi', 'status_temujanji', 'atlet'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'pegawai_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'sukan' => GeneralLabel::sukan,
            'bahagian_kecederaan' => GeneralLabel::bahagian_kecederaan,
            'jantina' => GeneralLabel::jantina,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'lokasi' => GeneralLabel::lokasi,
            'status_temujanji' => GeneralLabel::status_temujanji,
            'atlet' => GeneralLabel::atlet,
            'format' => GeneralLabel::format,
        ];
    }
}
