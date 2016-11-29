<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_skim_kebajikan".
 *
 * @property integer $skim_kebajikan_id
 * @property string $jenis_bantuan_skak
 * @property string $jumlah_bantuan
 * @property string $nama_pemohon
 * @property string $nama_penerima
 * @property string $jenis_sukan
 * @property string $masalah_dihadapi
 * @property string $tarikh_kejadian
 * @property string $lokasi_kejadian
 * @property string $jenis_bantuan_lain_yang_diterima
 * @property integer $kelulusan
 */
class SkimKebajikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_skim_kebajikan';
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
            [['jenis_bantuan_skak', 'jumlah_bantuan', 'nama_pemohon', 'nama_penerima', 'jenis_sukan', 'perkara', 'sukan', 'jenis_permohonan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah_bantuan', 'jumlah_kos_perubatan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['tarikh_kejadian', 'tarikh_kelulusan'], 'safe'],
            [['kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel_penerima'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['jenis_bantuan_skak', 'jenis_sukan', 'jenis_bantuan_lain_yang_diterima'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pemohon', 'nama_penerima'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['masalah_dihadapi', 'emel_penerima'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi_kejadian'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'muat_naik'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skim_kebajikan_id' => GeneralLabel::skim_kebajikan_id,
            'jenis_bantuan_skak' => GeneralLabel::jenis_bantuan,
            'jumlah_bantuan' => GeneralLabel::jumlah_bantuan,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'nama_penerima' => GeneralLabel::nama_penerima,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'masalah_dihadapi' => GeneralLabel::masalah_dihadapi,
            'tarikh_kejadian' => GeneralLabel::tarikh_kejadian,
            'lokasi_kejadian' => GeneralLabel::lokasi_kejadian,
            'jenis_bantuan_lain_yang_diterima' => GeneralLabel::jenis_bantuan_lain_yang_diterima,
            'kelulusan' => GeneralLabel::kelulusan,
            'jumlah_kos_perubatan' => GeneralLabel::jumlah_kos_perubatan,
            'jenis_permohonan' => GeneralLabel::jenis_tuntutan,
            'sukan' => GeneralLabel::pencapaian_tertinggi,
            'emel_penerima' => GeneralLabel::emel_penerima,
            'perkara' => GeneralLabel::perkara,
            'catatan' => GeneralLabel::catatan,
            'muat_naik' => GeneralLabel::muat_naik,
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
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'nama_pemohon']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    public function getRefJenisBantuanSKAK()
    {
        return $this->hasOne(RefJenisKebajikan::className(), ['id' => 'jenis_bantuan_skak']);
    }
}
