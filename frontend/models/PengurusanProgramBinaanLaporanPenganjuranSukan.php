<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
/**
 * This is the model class for table "tbl_pengurusan_program_binaan_laporan_penganjuran_sukan".
 *
 * @property integer $laporan_penganjuran_sukan_id
 * @property integer $pengurusan_program_binaan_id
 * @property integer $sukan_id
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanProgramBinaanLaporanPenganjuranSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_laporan_penganjuran_sukan';
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
            [['pengurusan_program_binaan_id'], 'required'],
            [['pengurusan_program_binaan_id', 'sukan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_penganjuran_sukan_id' => 'Laporan Penganjuran Sukan ID',
            'pengurusan_program_binaan_id' => 'Pengurusan Program Binaan ID',
            'sukan_id' => GeneralLabel::sukan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan_id']);
    }
}
