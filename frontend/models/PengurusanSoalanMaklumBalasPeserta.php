<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_soalan_maklum_balas_peserta".
 *
 * @property integer $pengurusan_soalan_maklum_balas_peserta_id
 * @property integer $pengurusan_maklum_balas_peserta_id
 * @property string $soalan
 * @property integer $rating
 */
class PengurusanSoalanMaklumBalasPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_soalan_maklum_balas_peserta';
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
            [['nama_temasya','kategori_penilaian', 'soalan', 'rating'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_maklum_balas_peserta_id', 'rating'], 'integer'],
            [['soalan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_soalan_maklum_balas_peserta_id' => GeneralLabel::pengurusan_soalan_maklum_balas_peserta_id,
            'pengurusan_maklum_balas_peserta_id' => GeneralLabel::pengurusan_maklum_balas_peserta_id,
            'kategori_penilaian' => GeneralLabel::kategori_penilaian,
            'nama_temasya' => GeneralLabel::nama_temasya,
            'soalan' => GeneralLabel::soalan,
            'rating' => GeneralLabel::rating,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSoalanPenilaianPeserta(){
        return $this->hasOne(RefSoalanPenilaianPeserta::className(), ['id' => 'soalan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefRatingSoalanPenilaianPeserta(){
        return $this->hasOne(RefRatingSoalanPenilaianPeserta::className(), ['id' => 'rating']);
    }
}
