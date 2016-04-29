<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class IsnLaporanSkimPelesenanKejurulatihanKebangsaan extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $kategori_perlesenan;
    public $status_perlesenan;
    public $sukan;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'kategori_perlesenan', 'status_perlesenan', 'sukan'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'kategori_perlesenan' => GeneralLabel::kategori_pensijilan,
            'status_perlesenan' => GeneralLabel::status_perlesenan,
            'sukan' => GeneralLabel::sukan,
            'format' => GeneralLabel::format,
        ];
    }
}
