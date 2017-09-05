<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_bantuan_pentadbiran_pejabat".
 *
 * @property integer $bantuan_pentadbiran_pejabat_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $status_permohonan
 * @property string $catatan
 */
class BantuanPentadbiranPejabat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_pentadbiran_pejabat';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_tel_bimbit', 'status_permohonan', 'emel'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'tarikh', 'tarikh_lantikan'], 'safe'],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['no_kad_pengenalan', 'alamat_poskod', 'no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_kelulusan', 'jumlah_dipohon'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama', 'nama_sue', 'jawatan', 'persatuan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod', 'status_permohonan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_bimbit', 'no_tel_pejabat', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel_bimbit', 'no_tel_pejabat', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['catatan', 'surat_permohonan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['surat_permohonan'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['nama', 'nama_sue', 'jawatan', 'persatuan','alamat_1', 'alamat_2', 'alamat_3','emel','alamat_negeri','alamat_bandar','catatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_pentadbiran_pejabat_id' => GeneralLabel::bantuan_pentadbiran_pejabat_id,
            'nama' => GeneralLabel::nama_pemohon,
            'jawatan' => GeneralLabel::jawatan,
            'persatuan' => GeneralLabel::persatuan,
            'tarikh' => GeneralLabel::tarikh_permohonan,
            'nama_sue' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_pejabat,
            'no_tel_pejabat' => GeneralLabel::no_untuk_dihubungi,
            'no_faks' => GeneralLabel::no_faks,
            'emel' => GeneralLabel::emel,
            'jumlah_dipohon' => GeneralLabel::jumlah_dipohon. ' (RM)',
            'status_permohonan' => GeneralLabel::status_permohonan,
            'catatan' => GeneralLabel::catatan,
            'tarikh_lantikan' => GeneralLabel::tarikh_lantikan,
            'jumlah_kelulusan' => GeneralLabel::jumlah_diluluskan,
			'surat_permohonan' => GeneralLabel::surat_permohonan_rasmi,
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

        if(!$file && $this->$attribute==""){
            $this->addError($attribute, GeneralMessage::uploadEmptyError);
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanBantuanPentadbiranPejabat(){
        return $this->hasOne(RefStatusPermohonanBantuanPentadbiranPejabat::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'persatuan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanBantuanPentadbiranPejabat(){
        return $this->hasOne(RefJawatanBantuanPentadbiranPejabat::className(), ['id' => 'jawatan']);
    }
}
