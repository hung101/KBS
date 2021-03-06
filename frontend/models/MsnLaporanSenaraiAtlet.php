<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanSenaraiAtlet extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $program;
    public $acara;
    public $sukan;
    public $negeri;
    public $format;
    public $atlet;
    public $kategori_kecacatan;
    public $umur_dari;
    public $umur_hingga;
    public $source;
    public $jenis_elaun;
    public $cawangan;
    public $jenis_pakaian;
    public $saiz_pakaian;
    public $tahap_pendidikan;
    public $umur_dari_2;
    public $umur_hingga_2;
    public $umur_dari_3;
    public $umur_hingga_3;
    public $umur_dari_4;
    public $umur_hingga_4;
    public $umur_dari_5;
    public $umur_hingga_5;
    public $umur_dari_6;
    public $umur_hingga_6;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan', 'negeri', 'acara', 'kategori_kecacatan', 'atlet', 'source', 'cawangan', 'jenis_elaun', 
                'jenis_pakaian', 'saiz_pakaian', 'tahap_pendidikan'], 'safe'],
            [['umur_hingga', 'umur_dari', 'umur_dari_2', 'umur_hingga_2', 'umur_dari_3',
                'umur_hingga_3', 'umur_dari_4', 'umur_hingga_4', 'umur_dari_5', 'umur_hingga_5', 'umur_dari_6', 'umur_hingga_6'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['jumlah_geran_hingga'], 'compare', 'compareAttribute'=>'negeri', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga'], 'compare', 'compareAttribute'=>'umur_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga_2'], 'compare', 'compareAttribute'=>'umur_dari_2', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga_3'], 'compare', 'compareAttribute'=>'umur_dari_3', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga_4'], 'compare', 'compareAttribute'=>'umur_dari_4', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga_5'], 'compare', 'compareAttribute'=>'umur_dari_5', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga_6'], 'compare', 'compareAttribute'=>'umur_dari_6', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
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
            'atlet' => GeneralLabel::atlet,
            'source' => GeneralLabel::source,
            'umur_dari' => GeneralLabel::umur_dari,
            'umur_hingga' => GeneralLabel::umur_hingga,
            'format' => GeneralLabel::format,
            'kategori_kecacatan' => GeneralLabel::kategori_kecacatan,
            'cawangan' => GeneralLabel::cawangan,
            'jenis_elaun' => GeneralLabel::jenis_elaun,
            'jenis_pakaian' => GeneralLabel::jenis_pakaian,
            'saiz_pakaian' => GeneralLabel::saiz_pakaian,
            'tahap_pendidikan' => GeneralLabel::tahap_pendidikan,
            'umur_dari_2' => GeneralLabel::umur_dari,
            'umur_hingga_2' => GeneralLabel::umur_hingga,
            'umur_dari_3' => GeneralLabel::umur_dari,
            'umur_hingga_3' => GeneralLabel::umur_hingga,
            'umur_dari_4' => GeneralLabel::umur_dari,
            'umur_hingga_4' => GeneralLabel::umur_hingga,
            'umur_dari_5' => GeneralLabel::umur_dari,
            'umur_hingga_5' => GeneralLabel::umur_hingga,
            'umur_dari_6' => GeneralLabel::umur_dari,
            'umur_hingga_6' => GeneralLabel::umur_hingga,
        ];
    }
}
