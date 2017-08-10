<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

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
            [['lokasi', 'jenis_kemudahan', 'pengurusan_kemudahan_venue_id','kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam','kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam', 'sukan_rekreasi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_kemudahan_venue_id', 'jumlah_kapasiti', 'bilangan_kekerapan_penyenggaran', 'kekerapan_penggunaan', 'kekerapan_kerosakan_berlaku', 'jenis_kemudahan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['cost_pembaikian','kadar_sewaan_sejam_siang','kadar_sewaan_sehari_siang','kadar_sewaan_seminggu_siang','kadar_sewaan_sebulan_siang','kadar_sewaan_sejam_malam','kadar_sewaan_sehari_malam','kadar_sewaan_seminggu_malam','kadar_sewaan_sebulan_malam'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['keluasan_padang', 'size'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar_1', 'gambar_2', 'gambar_3', 'gambar_4', 'gambar_5'],'validateFileUpload', 'skipOnEmpty' => false],
            [['keluasan_padang', 'size'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kemudahan_sedia_ada_id' => GeneralLabel::pengurusan_kemudahan_sedia_ada_id,
            'pengurusan_kemudahan_venue_id' => GeneralLabel::pengurusan_kemudahan_venue_id,
            'nama_kemudahan' => GeneralLabel::nama_kemudahan,
            'jenis_kemudahan' => GeneralLabel::jenis_kemudahan,
            'sukan_rekreasi' => GeneralLabel::sukan_rekreasi,
            'size' => GeneralLabel::size,
            'lokasi' => GeneralLabel::lokasi,
            'keluasan_padang' => GeneralLabel::keluasan_padang,
            'jumlah_kapasiti' => GeneralLabel::jumlah_kapasiti,
            'bilangan_kekerapan_penyenggaran' => GeneralLabel::bilangan_kekerapan_penyenggaran,
            'kekerapan_penggunaan' => GeneralLabel::kekerapan_penggunaan,
            'kekerapan_kerosakan_berlaku' => GeneralLabel::kekerapan_kerosakan_berlaku,
            'cost_pembaikian' => GeneralLabel::cost_pembaikian,
            'kadar_sewaan_sejam_siang' => GeneralLabel::kadar_sewaan_sejam_siang,
            'kadar_sewaan_sehari_siang' => GeneralLabel::kadar_sewaan_sehari_siang,
            'kadar_sewaan_seminggu_siang' => GeneralLabel::kadar_sewaan_seminggu_siang,
            'kadar_sewaan_sebulan_siang' => GeneralLabel::kadar_sewaan_sebulan_siang,
            'kadar_sewaan_sejam_malam' => GeneralLabel::kadar_sewaan_sejam_malam,
            'kadar_sewaan_sehari_malam' => GeneralLabel::kadar_sewaan_sehari_malam,
            'kadar_sewaan_seminggu_malam' => GeneralLabel::kadar_sewaan_seminggu_malam,
            'kadar_sewaan_sebulan_malam' => GeneralLabel::kadar_sewaan_sebulan_malam,
            'gambar_1' => GeneralLabel::gambar_1,
            'gambar_2' => GeneralLabel::gambar_2,
            'gambar_3' => GeneralLabel::gambar_3,
            'gambar_4' => GeneralLabel::gambar_4,
            'gambar_5' => GeneralLabel::gambar_5,
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
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
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
    
    /* ActiveRelation */
    public function getRefSukanRekreasi()
    {
        return $this->hasOne(RefSukanRekreasi::className(), ['id' => 'sukan_rekreasi']);
    }
    
    public function getSukanRekreasiDanJenisKemudahan(){
        if($this->refSukanRekreasi->desc && $this->refJenisKemudahan->desc){
            $returnValue = $this->refSukanRekreasi->desc . ' - ' . $this->refJenisKemudahan->desc;
        } elseif ($this->refSukanRekreasi->desc){
            $returnValue = $this->refSukanRekreasi->desc;
        } elseif ($this->refJenisKemudahan->desc){
            $returnValue = $this->refJenisKemudahan->desc;
        }
        
        $returnValue = $this->refSukanRekreasi->desc . ' - ' . $this->refJenisKemudahan->desc;
        
        return $returnValue;
    }
}
