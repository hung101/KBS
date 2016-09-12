<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_pendidikan_kursus_pengajian".
 *
 * @property integer $permohonan_pendidikan_kursus_pengajian_id
 * @property integer $permohonan_pendidikan_id
 * @property string $kursus_pengajian
 * @property string $universiti
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanPendidikanKursusPengajian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_pendidikan_kursus_pengajian';
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
            [['permohonan_pendidikan_id', 'created_by', 'updated_by'], 'integer'],
            [['kursus_pengajian', 'universiti'], 'required'],
            [['created', 'updated'], 'safe'],
            [['kursus_pengajian', 'universiti'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_pendidikan_kursus_pengajian_id' => 'Permohonan Pendidikan Kursus Pengajian ID',
            'permohonan_pendidikan_id' => 'Permohonan Pendidikan ID',
            'kursus_pengajian' => 'Kursus Pengajian',
            'universiti' => 'Universiti',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
