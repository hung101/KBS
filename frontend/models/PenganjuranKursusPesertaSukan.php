<?php

namespace app\models;

use Yii;

use app\models\general\GeneralVariable;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penganjuran_kursus_peserta_sukan".
 *
 * @property integer $penganjuran_kursus_peserta_sukan_id
 * @property integer $penganjuran_kursus_peserta_id
 * @property integer $jenis_sukan
 * @property integer $tahap
 * @property string $tahun
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenganjuranKursusPesertaSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus_peserta_sukan';
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
            [['jenis_sukan', 'tahap', 'tahun'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['penganjuran_kursus_peserta_id', 'jenis_sukan', 'tahap', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax, 'message' => GeneralMessage::yii_validation_integer, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
            [['created', 'updated'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_kursus_peserta_sukan_id' => 'Penganjuran Kursus Peserta Sukan ID',
            'penganjuran_kursus_peserta_id' => 'Penganjuran Kursus Peserta ID',
            'jenis_sukan' => 'Jenis Sukan',
            'tahap' => 'Tahap',
            'tahun' => 'Tahun',
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
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTahapSukanPeserta(){
        return $this->hasOne(RefTahapSukanPeserta::className(), ['id' => 'tahap']);
    }
}
