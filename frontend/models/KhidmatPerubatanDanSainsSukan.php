<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_khidmat_perubatan_dan_sains_sukan".
 *
 * @property integer $khidmat_perubatan_dan_sains_sukan_id
 * @property integer $kategori_servis
 * @property integer $servis
 * @property string $tempat
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $status
 * @property string $muat_naik
 * @property string $kecederaan_jika_ada
 * @property integer $sukan
 * @property integer $program
 * @property string $mod_latihan
 * @property string $sasaran
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class KhidmatPerubatanDanSainsSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_khidmat_perubatan_dan_sains_sukan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori_servis', 'tempat', 'tarikh_mula', 'tarikh_tamat', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['kategori_servis', 'servis', 'sukan', 'program', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status', 'mod_latihan', 'sasaran'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kecederaan_jika_ada'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'khidmat_perubatan_dan_sains_sukan_id' => 'Khidmat Perubatan Dan Sains Sukan ID',
            'kategori_servis' => 'Kategori Servis',
            'servis' => '(Sub)',
            'tempat' => GeneralLabel::tempat,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'status' => GeneralLabel::status,
            'muat_naik' => GeneralLabel::muat_naik,
            'kecederaan_jika_ada' => 'Kecederaan Jika Ada',
            'sukan' => 'Sukan',
            'program' => 'Program',
            'mod_latihan' => 'Mod Latihan',
            'sasaran' => 'Sasaran',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
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
    public function getRefStatusKhidmatPerubatan(){
        return $this->hasOne(RefStatusKhidmatPerubatan::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriServis(){
        return $this->hasOne(RefKategoriServis::className(), ['id' => 'kategori_servis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriServisSub(){
        return $this->hasOne(RefKategoriServisSub::className(), ['id' => 'servis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTempatKhidmatPerubatan(){
        return $this->hasOne(RefTempatKhidmatPerubatan::className(), ['id' => 'tempat']);
    }
}
