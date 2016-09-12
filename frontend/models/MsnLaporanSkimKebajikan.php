<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanSkimKebajikan extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $kelulusan;
    public $sukan;
    public $nama_kejohanan;
    public $jawatan;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'kelulusan', 'sukan', 'nama_kejohanan', 'jawatan'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'kelulusan' => GeneralLabel::kelulusan,
            'sukan' => GeneralLabel::sukan,
            'nama_kejohanan' => GeneralLabel::nama_kejohanan,
            'jawatan' => GeneralLabel::jawatan,
            'format' => GeneralLabel::format,
        ];
    }
}
