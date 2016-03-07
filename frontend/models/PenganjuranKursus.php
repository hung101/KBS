<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penganjuran_kursus".
 *
 * @property integer $penganjuran_kursus_id
 * @property string $tarikh_kursus
 * @property string $tempat_kursus
 * @property string $negeri
 * @property string $nama_penyelaras
 * @property string $no_telefon
 * @property integer $kuota_kursus
 */
class PenganjuranKursus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus';
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
            [['jenis_kursus', 'tarikh_kursus', 'tempat_kursus', 'negeri', 'nama_penyelaras', 'no_telefon', 'kuota_kursus'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kursus'], 'safe'],
            [['kuota_kursus'], 'integer'],
            [['tempat_kursus'], 'string', 'max' => 90],
            [['negeri'], 'string', 'max' => 30],
            [['nama_penyelaras'], 'string', 'max' => 80],
            [['no_telefon'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_kursus_id' => 'Penganjuran Kursus ID',
            'jenis_kursus' => 'Jenis Kursus',
            'negeri' => 'Negeri',
            'tarikh_kursus' => 'Tarikh Kursus',
            'tempat_kursus' => 'Tempat Kursus',
            'negeri' => 'Negeri',
            'nama_penyelaras' => 'Nama Penyelaras',
            'no_telefon' => 'No Telefon',
            'kuota_kursus' => 'Kuota Kursus',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKursusPenganjuran(){
        return $this->hasOne(RefJenisKursusPenganjuran::className(), ['id' => 'jenis_kursus']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
}
