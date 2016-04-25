<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik".
 *
 * @property integer $permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $sukan
 * @property string $tujuan
 * @property string $perkhidmatan
 */
class PermohonanPerkhidmatanAnalisaPerlawananDanBimekanik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik';
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
            [['atlet_id', 'tarikh', 'tujuan', 'perkhidmatan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'status'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['tujuan', 'perkhidmatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'sukan' => GeneralLabel::sukan,
            'tujuan' => GeneralLabel::tujuan,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'status' => GeneralLabel::status,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerkhidmatanBiomekanik(){
        return $this->hasOne(RefPerkhidmatanBiomekanik::className(), ['id' => 'perkhidmatan']);
    }
}
