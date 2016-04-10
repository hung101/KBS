<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class PermohonanEBantuanLaporanStatusPermohonanBantuan extends Model
{

    public $jumlah_dilulus_dari;
    public $jumlah_dilulus_hingga;
    public $jumlah_dipohon_dari;
    public $jumlah_dipohon_hingga;
    public $negeri;
    public $tarikh_terima_dari;
    public $tarikh_terima_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['jumlah_dilulus_dari', 'jumlah_dilulus_hingga', 'jumlah_dipohon_dari', 'jumlah_dipohon_hingga', 'negeri', 'tarikh_terima_dari', 'tarikh_terima_hingga'], 'safe'],
            [['jumlah_dilulus_dari', 'jumlah_dilulus_hingga', 'jumlah_dipohon_dari', 'jumlah_dipohon_hingga'], 'number'],
            [['tarikh_terima_hingga'], 'compare', 'compareAttribute'=>'tarikh_terima_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'jumlah_dilulus_dari' => GeneralLabel::jumlah_dilulus_dari,
            'jumlah_dilulus_hingga' => GeneralLabel::jumlah_dilulus_hingga,
            'jumlah_dipohon_dari' => GeneralLabel::jumlah_dipohon_dari,
            'jumlah_dipohon_hingga' => GeneralLabel::jumlah_dipohon_hingga,
            'negeri' => GeneralLabel::negeri,
            'tarikh_terima_dari' => GeneralLabel::tarikh_terima_dari,
            'tarikh_terima_hingga' => GeneralLabel::tarikh_terima_hingga,
            'format' => GeneralLabel::format,

        ];
    }
}
