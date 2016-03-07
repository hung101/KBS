<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_kewangan".
 *
 * @property integer $pengurusan_kewangan_id
 * @property string $nama_acara_program
 * @property string $tarikh_acara
 * @property string $kategori_acara
 * @property string $objektif
 * @property string $kategori_penggunaan
 * @property string $harga_penggunaan
 * @property string $jumlah_bajet
 * @property string $jumlah_penggunaan
 * @property string $catatan
 * @property string $bajet_keseluruhan
 * @property string $penggunaan_keseluruhan
 * @property string $baki
 */
class PengurusanKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kewangan';
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
            [['nama_acara_program', 'tarikh_acara', 'kategori_penggunaan', 'harga_penggunaan', 'jumlah_bajet', 'jumlah_penggunaan', 'bajet_keseluruhan', 'penggunaan_keseluruhan', 'baki'], 'required', 'skipOnEmpty' => true],
            [['tarikh_acara'], 'safe'],
            [['harga_penggunaan', 'jumlah_bajet', 'jumlah_penggunaan', 'bajet_keseluruhan', 'penggunaan_keseluruhan', 'baki'], 'number'],
            [['nama_acara_program', 'kategori_acara', 'kategori_penggunaan'], 'string', 'max' => 80],
            [['objektif', 'catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kewangan_id' => 'Pengurusan Kewangan ID',
            'nama_acara_program' => 'Sukan',
            'tarikh_acara' => 'Tarikh',
            'kategori_acara' => 'Kategori Acara',
            'objektif' => 'Objektif',
            'kategori_penggunaan' => 'Kategori Penggunaan',
            'harga_penggunaan' => 'Harga Penggunaan',
            'jumlah_bajet' => 'Jumlah Bajet',
            'jumlah_penggunaan' => 'Jumlah Penggunaan',
            'catatan' => 'Catatan',
            'bajet_keseluruhan' => 'Bajet Keseluruhan',
            'penggunaan_keseluruhan' => 'Penggunaan Keseluruhan',
            'baki' => 'Baki',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_acara_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPenggunaan(){
        return $this->hasOne(RefKategoriPenggunaan::className(), ['id' => 'kategori_penggunaan']);
    }
}
