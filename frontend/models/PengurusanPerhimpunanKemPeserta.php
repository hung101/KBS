<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem_peserta".
 *
 * @property integer $pengurusan_perhimpunan_kem_peserta_id
 * @property integer $pengurusan_perhimpunan_kem_id
 * @property string $nama_peserta
 * @property string $kategori_peserta
 * @property string $jawatan
 */
class PengurusanPerhimpunanKemPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhimpunan_kem_peserta';
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
            [['nama_peserta', 'kategori_peserta', 'jawatan'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_perhimpunan_kem_id'], 'integer'],
            [['nama_peserta'], 'string', 'max' => 80],
            [['kategori_peserta', 'jawatan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhimpunan_kem_peserta_id' => 'Pengurusan Perhimpunan Kem Peserta ID',
            'pengurusan_perhimpunan_kem_id' => 'Pengurusan Perhimpunan Kem ID',
            'nama_peserta' => 'Nama Peserta',
            'kategori_peserta' => 'Kategori Peserta',
            'jawatan' => 'Jawatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPesertaPerhimpunanKem(){
        return $this->hasOne(RefKategoriPesertaPerhimpunanKem::className(), ['id' => 'kategori_peserta']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanPesertaPerhimpunanKem(){
        return $this->hasOne(RefJawatanPesertaPerhimpunanKem::className(), ['id' => 'jawatan']);
    }
}
