<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanRingkasanStatistikKomplimentari extends Model
{
    public $tahun;
    public $kategori_program_id;
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
            [['format','tahun'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['kategori_program_id', 'pegawai_bertanggungjawab', 'sukan', 'jantina', 'perkhidmatan','lokasi', 'status_temujanji', 'atlet'], 'safe'],
            [['tahun'], 'integer', 'min'=>GeneralVariable::yearMin, 'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
        ];
    }

    public function attributeLabels()
    {
        return [
            'kategori_program_id' => GeneralLabel::kategori_program,
            'tahun' => GeneralLabel::tahun,
            'pegawai_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'sukan' => GeneralLabel::sukan,
            'jantina' => GeneralLabel::jantina,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'lokasi' => GeneralLabel::lokasi,
            'status_temujanji' => GeneralLabel::status_temujanji,
            'atlet' => GeneralLabel::atlet,
            'format' => GeneralLabel::format,

        ];
    }
}
