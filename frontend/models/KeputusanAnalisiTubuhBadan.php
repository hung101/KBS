<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_keputusan_analisi_tubuh_badan".
 *
 * @property integer $keputusan_analisi_tubuh_badan_id
 * @property integer $perkhidmatan_permakanan_id
 * @property string $kategori_atlet
 * @property string $sukan
 * @property string $acara
 * @property string $atlet
 * @property string $fit
 * @property string $unfit
 * @property string $refer
 */
class KeputusanAnalisiTubuhBadan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_keputusan_analisi_tubuh_badan';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['refer', 'kandungan_lemak_badan', 'tarikh'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['perkhidmatan_permakanan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kategori_atlet'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['sukan', 'acara', 'atlet', 'fit', 'unfit', 'refer'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_atlet','sukan', 'acara', 'atlet', 'fit', 'unfit', 'refer'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keputusan_analisi_tubuh_badan_id' => GeneralLabel::keputusan_analisi_tubuh_badan_id,
            'perkhidmatan_permakanan_id' => GeneralLabel::perkhidmatan_permakanan_id,
            'kategori_atlet' => GeneralLabel::kategori_atlet,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'atlet' => GeneralLabel::atlet,
            'fit' => GeneralLabel::fit,
            'unfit' => GeneralLabel::unfit,
            'refer' => GeneralLabel::refer,
            'tarikh' => GeneralLabel::tarikh,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKandunganLemakBadan(){
        return $this->hasOne(RefKandunganLemakBadan::className(), ['id' => 'kandungan_lemak_badan']);
    }
}
