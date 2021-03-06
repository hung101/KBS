<?php

namespace app\models;

use Yii;

use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;
use common\models\general\GeneralFunction;

/**
 * This is the model class for table "tbl_pengurusan_insuran".
 *
 * @property integer $pengurusan_insuran_id
 * @property integer $atlet_id
 * @property string $nama_insuran
 * @property string $jumlah_tuntutan
 * @property string $tarikh_tuntutan
 * @property string $pegawai_yang_bertanggungjawab
 */
class PengurusanInsuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insuran';
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
            [['atlet_id', 'nama_insuran', 'jumlah_tuntutan', 'tarikh_tuntutan', 'pegawai_yang_bertanggungjawab', 'sukan', 'program', 
                'ic_no', 'tarikh_kejadian', 'jenis_tuntutan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'jenis_tuntutan', 'status_permohonan', 'ic_no', 'jenis_bank', 'kelulusan_jkb'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_tuntutan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_tuntutan', 'catatan', 'tarikh_kejadian', 'tarikh_pembayaran', 'tarikh_permohonan', 'butiran_kemalangan', 'tarikh_jkb'], 'safe'],
            [['nama_insuran', 'pegawai_yang_bertanggungjawab', 'bilangan_jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ic_no'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_acc','no_polisi'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lampiran', 'tindakan_rujukan_memo'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lampiran'],'validateFileUpload', 'skipOnEmpty' => false],
            [['nama_insuran', 'pegawai_yang_bertanggungjawab', 'bilangan_jkb','no_acc','no_polisi', 'tindakan_rujukan_memo'], function ($attribute, $params) {
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
            'pengurusan_insuran_id' => GeneralLabel::pengurusan_insuran_id,
            'atlet_id' => GeneralLabel::nama_penerima,
            'nama_insuran' => GeneralLabel::nama_insuran,
            'jumlah_tuntutan' => GeneralLabel::jumlah_tuntutan,
            'tarikh_tuntutan' => GeneralLabel::tarikh_tuntutan,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::nama_pemohon,
            'catatan' => GeneralLabel::sebab_tuntutan,
            'sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'ic_no' => GeneralLabel::ic_no_insuran,
            'lampiran' => GeneralLabel::lampiran,
            'no_acc' => GeneralLabel::no_akaun_bank,
            'jenis_tuntutan' => GeneralLabel::jenis_tuntutan,
            'tarikh_kejadian' => GeneralLabel::tarikh_kejadian,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'tarikh_pembayaran' => GeneralLabel::tarikh_pembayaran,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'tindakan_rujukan_memo' => GeneralLabel::tindakan_rujukan_memo,
            'no_polisi' => GeneralLabel::no_polisi,
            'jenis_bank' => GeneralLabel::jenis_bank,
            'butiran_kemalangan' => GeneralLabel::butiran_kemalangan,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'kelulusan_jkb' => GeneralLabel::kelulusan_jkb,
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
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanInsuran(){
        return $this->hasOne(RefStatusPermohonanInsuran::className(), ['id' => 'status_permohonan']);
    }
}
