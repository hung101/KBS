<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;

/**
 * This is the model class for table "tbl_pengurusan_kemudahan_sedia_ada".
 *
 * @property integer $pengurusan_kemudahan_sedia_ada_id
 * @property integer $pengurusan_kemudahan_venue_id
 * @property string $keluasan_padang
 * @property integer $jumlah_kapasiti
 * @property integer $bilangan_kekerapan_penyenggaran
 * @property integer $kekerapan_penggunaan
 * @property integer $kekerapan_kerosakan_berlaku
 * @property string $cost_pembaikian
 */
class PengurusanKemudahanSediaAda extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kemudahan_sedia_ada';
    }
    
    public function behaviors()
    {
        return [
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
            [['lokasi', 'jenis_kemudahan','kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam','kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_kemudahan_venue_id', 'jumlah_kapasiti', 'bilangan_kekerapan_penyenggaran', 'kekerapan_penggunaan', 'kekerapan_kerosakan_berlaku', 'jenis_kemudahan'], 'integer'],
            [['cost_pembaikian','kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam','kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam'], 'number'],
            [['keluasan_padang', 'size'], 'string', 'max' => 50],
            [['gambar_1', 'gambar_2', 'gambar_3', 'gambar_4', 'gambar_5'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_sedia_ada_id' => 'Pengurusan Kemudahan Sedia Ada ID',
            'pengurusan_kemudahan_venue_id' => 'Nama Kemudahan',
            'nama_kemudahan' => 'Nama Kemudahan',
            'jenis_kemudahan' => 'Jenis Kemudahan',
            'size' => 'Size',
            'lokasi' => 'Lokasi',
            'keluasan_padang' => 'Keluasan',
            'jumlah_kapasiti' => 'Jumlah Kapasiti',
            'bilangan_kekerapan_penyenggaran' => 'Bilangan Kekerapan Penyenggaran',
            'kekerapan_penggunaan' => 'Kekerapan Penggunaan',
            'kekerapan_kerosakan_berlaku' => 'Kekerapan Kerosakan Berlaku',
            'cost_pembaikian' => 'Kos Pembaikian',
            'kadar_sewaan_sejam_siang' => 'Sejam - Siang (RM)',
            'kadar_sewaan_sehari_siang' => 'Sehari - Siang (RM)',
            'kadar_sewaan_seminggu_siang' => 'Seminggu - Siang (RM)',
            'kadar_sewaan_sebulan_siang' => 'Sebulan - Siang (RM)',
            'kadar_sewaan_sejam_malam' => 'Sejam - Malam (RM)',
            'kadar_sewaan_sehari_malam' => 'Sehari - Malam (RM)',
            'kadar_sewaan_seminggu_malam' => 'Seminggu - Malam (RM)',
            'kadar_sewaan_sebulan_malam' => 'Sebulan - Malam (RM)',
            'gambar_1' => 'Gambar 1',
            'gambar_2' => 'Gambar 2',
            'gambar_3' => 'Gambar 3',
            'gambar_4' => 'Gambar 4',
            'gambar_5' => 'Gambar 5',
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanVenue(){
        return $this->hasOne(PengurusanKemudahanVenue::className(), ['pengurusan_kemudahan_venue_id' => 'pengurusan_kemudahan_venue_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKemudahan(){
        return $this->hasOne(RefJenisKemudahan::className(), ['id' => 'jenis_kemudahan']);
    }
}
