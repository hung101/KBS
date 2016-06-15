<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanSenaraiSukarelawan extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $negeri;
    public $jantina;
    public $umur_dari;
    public $umur_hingga;
    public $bidang_diminati;
    public $bangsa;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['umur_dari', 'umur_hingga'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_dari', 'tarikh_hingga', 'negeri', 'jantina', 'bidang_diminati', 'bangsa'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['umur_hingga'], 'compare', 'compareAttribute'=>'umur_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'negeri' => GeneralLabel::negeri,
            'jantina' => GeneralLabel::jantina,
            'bidang_diminati' => GeneralLabel::kecenderungan,
            'umur_dari' => GeneralLabel::umur_dari,
            'umur_hingga' => GeneralLabel::umur_hingga,
            'bangsa' => GeneralLabel::bangsa,
            'format' => GeneralLabel::format,
        ];
    }
}
