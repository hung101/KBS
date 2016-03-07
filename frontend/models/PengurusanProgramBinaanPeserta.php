<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan_peserta".
 *
 * @property integer $pengurusan_program_binaan_peserta_id
 * @property integer $pengurusan_program_binaan_id
 * @property string $kategori_peserta
 * @property string $atlet_id
 * @property string $nama_peserta
 * @property string $jantina
 */
class PengurusanProgramBinaanPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_peserta';
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
            [['kategori_peserta', 'nama_peserta', 'jantina', 'peranan_peserta'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_program_binaan_id', 'atlet_id', 'jurulatih_id', 'peranan_peserta'], 'integer'],
            [['kategori_peserta'], 'string', 'max' => 30],
            [['nama_peserta'], 'string', 'max' => 80],
            [['jantina'], 'string', 'max' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_binaan_peserta_id' => 'Pengurusan Program Binaan Peserta ID',
            'pengurusan_program_binaan_id' => 'Pengurusan Program Binaan ID',
            'kategori_peserta' => 'Kategori Peserta',
            'atlet_id' => 'Atlet',
            'jurulatih_id' => 'Jurulatih',
            'nama_peserta' => 'Nama Peserta',
            'jantina' => 'Jantina',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPesertaProgramBinaan(){
        return $this->hasOne(RefKategoriPesertaProgramBinaan::className(), ['id' => 'kategori_peserta']);
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
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
