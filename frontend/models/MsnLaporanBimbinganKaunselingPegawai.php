<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanBimbinganKaunselingPegawai extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $nama_ppn;
    public $sukan;
    public $jumlah_pemantauan;
    public $negeri;
    public $kategori_masalah;
    public $status_jawatan;
    public $bahagian;
    public $taraf_perkahwinan;
    public $format;

    public function rules()
    {
        return [
            [['format', 'jumlah_pemantauan'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'nama_ppn', 'sukan', 'negeri', 'status_jawatan', 'kategori_masalah', 'bahagian', 'taraf_perkahwinan'], 'safe'],
            [['jumlah_pemantauan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'nama_ppn' => GeneralLabel::nama_ppn,
            'sukan' => GeneralLabel::sukan,
            'negeri' => GeneralLabel::negeri,
            'jumlah_pemantauan' => GeneralLabel::jumlah_pemantauan,
            'format' => GeneralLabel::format,
        ];
    }
}
