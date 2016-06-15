<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_sukarelawan".
 *
 * @property integer $sukarelawan_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $no_tel_bimbit
 * @property string $status
 * @property string $emel
 * @property string $facebook
 * @property integer $kebatasan_fizikal
 * @property string $menyatakan_jika_ada_kebatasan_fizikal
 * @property string $kelulusan_akademi
 * @property string $bidang_kepakaran
 * @property string $pekerjaan_semasa
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $bidang_diminati
 * @property string $waktu_ketika_diperlukan
 * @property string $menyatakan_waktu_ketika_diperlukan
 * @property string $muatnaik
 */
class Sukarelawan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_sukarelawan';
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
            [['nama', 'no_kad_pengenalan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 
                'tarikh_lahir', 'jantina', 'no_tel_bimbit', 'status', 'kebatasan_fizikal', 'kelulusan_akademi', 
                'bidang_kepakaran', 'pekerjaan_semasa', 'alamat_majikan_1', 'alamat_majikan_negeri', 
                'alamat_majikan_bandar', 'alamat_majikan_poskod', 'bidang_diminati', 'waktu_ketika_diperlukan', 
                'clause', 'bangsa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'bangsa'], 'safe'],
            [['kebatasan_fizikal'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama', 'menyatakan_jika_ada_kebatasan_fizikal', 'kelulusan_akademi', 'bidang_kepakaran', 
                'pekerjaan_semasa', 'nama_majikan', 'bidang_diminati', 'waktu_ketika_diperlukan', 
                'menyatakan_waktu_ketika_diperlukan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri', 'status', 'alamat_majikan_negeri', 'saiz_baju'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel', 'facebook', 'muatnaik', 'bidang_diminati_lain_lain'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pengalaman_sukarelawan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['muatnaik'],'validateFileUpload', 'skipOnEmpty' => false],
            [['muatnaik'], 'validateFileUploadWithRequired', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sukarelawan_id' => GeneralLabel::sukarelawan_id,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'jantina' => GeneralLabel::jantina,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'status' => GeneralLabel::status,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'saiz_baju' => GeneralLabel::saiz_baju,
            'kebatasan_fizikal' => GeneralLabel::kebatasan_fizikal,
            'menyatakan_jika_ada_kebatasan_fizikal' => GeneralLabel::menyatakan_jika_ada_kebatasan_fizikal,
            'kelulusan_akademi' => GeneralLabel::kelulusan_akademi,
            'bidang_kepakaran' => GeneralLabel::bidang_kepakaran,
            'pekerjaan_semasa' => GeneralLabel::pekerjaan_semasa,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,
            'bidang_diminati' => GeneralLabel::kecenderungan,
            'bidang_diminati_lain_lain' => GeneralLabel::bidang_diminati_lain_lain,
            'waktu_ketika_diperlukan' => GeneralLabel::waktu_ketika_diperlukan,
            'menyatakan_waktu_ketika_diperlukan' => GeneralLabel::menyatakan_waktu_ketika_diperlukan,
            'muatnaik' => GeneralLabel::gambar_muat_naik,
            'clause' => GeneralLabel::clause,
            'pengalaman_sukarelawan' => GeneralLabel::pengalaman_sukarelawan,
            'bangsa' => GeneralLabel::bangsa,
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
     * Validate upload file cannot be empty
     */
    public function validateFileUploadWithRequired($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBandar(){
        return $this->hasOne(RefBandar::className(), ['id' => 'alamat_bandar']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'alamat_negeri']);
    }
}
