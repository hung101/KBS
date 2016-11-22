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
    public $cawangan;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan', 'negeri', 'acara', 'kategori_kecacatan', 'atlet', 'source', 'cawangan'], 'safe'],
            [['umur_hingga', 'umur_dari'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['jumlah_geran_hingga'], 'compare', 'compareAttribute'=>'negeri', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga'], 'compare', 'compareAttribute'=>'umur_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
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
        ];
    }
}
