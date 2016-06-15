<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pakaian_peralatan".
 *
 * @property integer $peralatan_id
 * @property integer $atlet_id
 * @property string $jenis_sukan
 * @property string $saiz
 * @property string $jenama
 * @property string $warna
 */
class AtletPakaianPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pakaian_peralatan';
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
            [['atlet_id', 'tarikh_serahan', 'peralatan','jenis_sukan', 'jenama'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jenis_sukan', 'jenama'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['model'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['saiz', 'warna'], 'string', 'max' => 10, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'peralatan_id' => GeneralLabel::peralatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'peralatan' => GeneralLabel::nama_peralatan,
            'saiz' => GeneralLabel::saiz,
            'jenama' => GeneralLabel::jenama,
            'model' => GeneralLabel::model,
            'warna' => GeneralLabel::warna,
            'tarikh_serahan' => GeneralLabel::tarikh_serahan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenamaPeralatan(){
        return $this->hasOne(RefJenamaPeralatan::className(), ['id' => 'jenama']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanPinjaman(){
        return $this->hasOne(RefPeralatanPinjaman::className(), ['id' => 'peralatan']);
    }
}
