<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_shuttle_bus".
 *
 * @property integer $pengurusan_shuttle_bus_id
 * @property integer $atlet_id
 * @property string $tarikh_mula
 * @property string $tarikh_akhir
 * @property string $pilihan_shuttle
 */
class PengurusanShuttleBus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_shuttle_bus';
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
            [['atlet_id', 'tarikh_mula', 'tarikh_akhir', 'pilihan_shuttle'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            //[['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'tarikh_akhir', 'catatan'], 'safe'],
            [['atlet_id'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lampiran_senarai_nama'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pilihan_shuttle'], 'string', 'max' => 120, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['atlet_id','pilihan_shuttle', 'lampiran_senarai_nama'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_shuttle_bus_id' => GeneralLabel::pengurusan_shuttle_bus_id,
            'atlet_id' => 'Tempat / Destinasi',
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_akhir' => GeneralLabel::tarikh_akhir,
            'pilihan_shuttle' => 'Nama Pemandu',
            'catatan' => GeneralLabel::catatan,

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
    public function getRefShuttle(){
        return $this->hasOne(RefShuttle::className(), ['id' => 'pilihan_shuttle']);
    }
}
