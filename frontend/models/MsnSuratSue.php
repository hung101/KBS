<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnSuratSue extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $program;
    public $acara;
    public $sukan;
    public $negeri;
    public $format;
    public $atlet;
    public $sue_id;
    public $kategori_kecacatan;
    public $source;

    public function rules()
    {
        return [
            [['format', 'sue_id'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga', 'program', 'sukan', 'negeri', 'acara', 'kategori_kecacatan', 'atlet', 'source'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['jumlah_geran_hingga'], 'compare', 'compareAttribute'=>'negeri', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
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
            'format' => GeneralLabel::format,
            'kategori_kecacatan' => GeneralLabel::kategori_kecacatan,
        ];
    }
}
