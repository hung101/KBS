<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanMaklumatPembayaranGeranBantuan extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $program;
    public $sukan;
    public $jumlah_geran_dari;
    public $jumlah_geran_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan'], 'safe'],
            [['jumlah_geran_hingga', 'jumlah_geran_dari'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['jumlah_geran_hingga'], 'compare', 'compareAttribute'=>'jumlah_geran_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'jumlah_geran_dari' => GeneralLabel::jumlah_geran_dari,
            'jumlah_geran_hingga' => GeneralLabel::jumlah_geran_hingga,
            'format' => GeneralLabel::format,
        ];
    }
}
