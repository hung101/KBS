<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;


class PjsLaporanPenganjuranAcara extends Model
{
    public $peringkat;
    public $tarikh_dari;
    public $tarikh_hingga;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required'],
            [['tarikh_dari', 'tarikh_hingga', 'peringkat'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true],
        ];
    }

    public function attributeLabels()
    {
        return [
            'peringkat' => GeneralLabel::peringkat,
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'format' => GeneralLabel::format,

        ];
    }
}
