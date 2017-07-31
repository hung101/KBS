<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanJurulatihWajaran extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $program;
    public $acara;
    public $sukan;
    public $negeri;
    public $negara;
    public $status;
    public $jurulatih;
    public $created_by;
    public $format;
    public $laporan_jurulatih;
    public $prestasi_atlet;
    public $kenaikan_gaji_elaun;

    public function rules()
    {
        return [
            [['format', 'jurulatih', 'laporan_jurulatih', 'prestasi_atlet', 'kenaikan_gaji_elaun'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['laporan_jurulatih', 'prestasi_atlet'], 'number', 'max' => 40, 'message' => GeneralMessage::yii_validation_number, 'tooBig' => GeneralMessage::yii_validation_integer_max],
            [[ 'kenaikan_gaji_elaun'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan', 'negeri', 'acara', 'status', 'created_by', 'negara'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'negeri' => GeneralLabel::negeri,
            'acara' => GeneralLabel::acara,
            'status' => GeneralLabel::status,
            'negara' => GeneralLabel::negara,
            'jurulatih' => GeneralLabel::jurulatih,
            'laporan_jurulatih' => "Laporan Jurulatih & CCE (40%)",
            'prestasi_atlet' => "Prestasi Atlet (Di Temasya / Kejohanan) (40%)",
            'kenaikan_gaji_elaun' => "Jumlah Kenaikan Gaji / Elaun) (RM)",
            'format' => GeneralLabel::format,
        ];
    }
}
