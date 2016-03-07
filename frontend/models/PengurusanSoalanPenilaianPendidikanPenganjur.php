<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_soalan_penilaian_pendidikan_penganjur".
 *
 * @property integer $pengurusan_soalan_penilaian_pendidikan_penganjur_id
 * @property integer $pengurusan_penilaian_pendidikan_penganjur_intructor_id
 * @property string $soalan
 * @property integer $rating
 */
class PengurusanSoalanPenilaianPendidikanPenganjur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_soalan_penilaian_pendidikan_penganjur';
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
            [['soalan', 'rating'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_penilaian_pendidikan_penganjur_intructor_id', 'rating'], 'integer'],
            [['soalan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_soalan_penilaian_pendidikan_penganjur_id' => 'Pengurusan Soalan Penilaian Pendidikan Penganjur ID',
            'pengurusan_penilaian_pendidikan_penganjur_intructor_id' => 'Pengurusan Penilaian Pendidikan Penganjur Intructor ID',
            'soalan' => 'Soalan',
            'rating' => 'Rating',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanPenilaianPendidikanPenganjurInstructor(){
        return $this->hasOne(RefSoalanPenilaianPendidikanPenganjurInstructor::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRatingSoalan(){
        return $this->hasOne(RefRatingSoalan::className(), ['id' => 'rating']);
    }
}
