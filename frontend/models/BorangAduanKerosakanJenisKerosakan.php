<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
/**
 * This is the model class for table "tbl_borang_aduan_kerosakan_jenis_kerosakan".
 *
 * @property integer $borang_aduan_kerosakan_jenis_kerosakan_id
 * @property integer $borang_aduan_kerosakan_id
 * @property string $lokasi
 * @property string $jenis_kerosakan
 * @property string $nama_pemeriksa
 * @property string $tarikh_pemeriksaan
 * @property string $kategori_kerosakan
 * @property string $tindakan
 * @property string $catatan
 * @property integer $selesai
 * @property string $ulasan_pemeriksa
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BorangAduanKerosakanJenisKerosakan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_aduan_kerosakan_jenis_kerosakan';
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
            [['lokasi', 'jenis_kerosakan', 'nama_pemeriksa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['borang_aduan_kerosakan_id', 'selesai', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_pemeriksaan', 'created', 'updated'], 'safe'],
            [['lokasi', 'nama_pemeriksa', 'kategori_kerosakan', 'tindakan'], 'string', 'max' => 80],
            [['jenis_kerosakan', 'session_id'], 'string', 'max' => 100],
            [['catatan', 'ulasan_pemeriksa', 'gambar'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_aduan_kerosakan_jenis_kerosakan_id' => 'Borang Aduan Kerosakan Jenis Kerosakan ID',
            'borang_aduan_kerosakan_id' => 'Borang Aduan Kerosakan ID',
            'lokasi' => GeneralLabel::lokasi, //'Lokasi',
            'jenis_kerosakan' => GeneralLabel::jenis_kerosakan, //'Jenis Kerosakan',
            'nama_pemeriksa' => GeneralLabel::nama_pemeriksa, //'Nama Pemeriksa',
            'tarikh_pemeriksaan' => GeneralLabel::tarikh_pemeriksaan, //'Tarikh Pemeriksaan',
            'kategori_kerosakan' => GeneralLabel::kategori_kerosakan, //'Kategori Kerosakan',
            'tindakan' => GeneralLabel::tindakan, //'Tindakan',
            'catatan' => GeneralLabel::catatan, //'Catatan',
            'selesai' => GeneralLabel::selesai, //'Selesai',
            'ulasan_pemeriksa' => GeneralLabel::ulasan_pemeriksa, //'Ulasan Pemeriksa',
            'gambar' => GeneralLabel::gambar, //'Gambar',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    
    
    public function upload()
    {
        if ($this->validate()) {
            $this->gambar->saveAs('uploads/' . $this->gambar->baseName . '.' . $this->gambar->extension);
            return true;
        } else {
            return false;
        }
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
    public function getRefNamaPemeriksaAduan(){
        return $this->hasOne(RefNamaPemeriksaAduan::className(), ['id' => 'nama_pemeriksa']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKerosakan(){
        return $this->hasOne(RefKategoriKerosakan::className(), ['id' => 'kategori_kerosakan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'selesai']);
    }
    
}
