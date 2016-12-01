<?php

namespace app\models;

use Yii;
use yii\base\Model;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


class MsnLaporanAcaraKejohananTemasya extends Model
{
    public $tarikh_dari;
    public $tarikh_hingga;
    public $kejohanan;
    public $temasya;
    public $format;

    public function rules()
    {
        return [
            [['format'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_dari', 'tarikh_hingga','kejohanan', 'temasya'], 'safe'],
            [['tarikh_hingga'], 'compare', 'compareAttribute'=>'tarikh_dari', 'operator'=>'>=', 'skipOnEmpty'=>true, 'message' => GeneralMessage::yii_validation_compare],
            [['kejohanan, temasya'], 'validateKejohananTemasya', 'skipOnEmpty' => false],
        ];
    }

    public function attributeLabels()
    {
        return [
            'tarikh_dari' => GeneralLabel::tarikh_dari,
            'tarikh_hingga' => GeneralLabel::tarikh_hingga,
            'kejohanan' => GeneralLabel::kejohanan,
            'temasya' => GeneralLabel::temasya,
            'format' => GeneralLabel::format,
        ];
    }
    
    public function validateKejohananTemasya()
    {
        if (($this->kejohanan==null)&&($this->temasya==null))      
        {
                $this->addError('kejohanan', GeneralMessage::yii_validation_required_either);
                $this->addError('temasya', GeneralMessage::yii_validation_required_either);
        } else if (($this->kejohanan!=null)&&($this->temasya!=null))      
        {
                $this->addError('kejohanan', GeneralMessage::yii_validation_required_only_one);
                $this->addError('temasya', GeneralMessage::yii_validation_required_only_one);
        }
    }
}
