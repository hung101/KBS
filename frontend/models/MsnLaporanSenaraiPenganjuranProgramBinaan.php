<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanSenaraiPenganjuranProgramBinaan extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $negeri;
    public $program;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'negeri', 'program'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'negeri' => GeneralLabel::negeri,
            'program' => GeneralLabel::program,
            'format' => GeneralLabel::format,
        ];
    }
}
