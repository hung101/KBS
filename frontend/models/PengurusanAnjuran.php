<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_anjuran".
 *
 * @property integer $pengurusan_anjuran_id
 * @property string $nama_program_anjuran
 * @property string $tarikh_program_anjuran
 * @property string $nama_badan_sukan_antarabangsa
 * @property string $nama_delegasi
 * @property string $negara
 */
class PengurusanAnjuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_anjuran';
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
            [['nama_program_anjuran', 'tarikh_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi', 'negara'], 'required', 'skipOnEmpty' => true],
            [['tarikh_program_anjuran'], 'safe'],
            [['nama_program_anjuran', 'nama_badan_sukan_antarabangsa', 'nama_delegasi'], 'string', 'max' => 80],
            [['negara'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_anjuran_id' => 'Pengurusan Anjuran ID',
            'nama_program_anjuran' => 'Nama Program Anjuran',
            'tarikh_program_anjuran' => 'Tarikh Program Anjuran',
            'nama_badan_sukan_antarabangsa' => 'Nama Badan Sukan Antarabangsa',
            'nama_delegasi' => 'Nama Delegasi',
            'negara' => 'Negara',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBadanSukanAntarabangsa(){
        return $this->hasOne(RefBadanSukanAntarabangsa::className(), ['id' => 'nama_badan_sukan_antarabangsa']);
    }
}
