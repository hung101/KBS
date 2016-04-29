<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_farmasi_permohonan_ubatan".
 *
 * @property integer $farmasi_permohonan_ubatan_id
 * @property integer $atlet_id
 * @property string $tarikh_pemberian
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 * @property integer $kelulusan
 */
class FarmasiPermohonanUbatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_farmasi_permohonan_ubatan';
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
            //[['atlet_id', 'tarikh_pemberian', 'pegawai_yang_bertanggungjawab', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan', 'kategori_atlet', 'jenis_sukan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_pemberian'], 'safe'],
            [['pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'farmasi_permohonan_ubatan_id' => GeneralLabel::farmasi_permohonan_ubatan_id,
            'atlet_id' => GeneralLabel::nama_pemohon,
            'tarikh_pemberian' => GeneralLabel::tarikh_pemberian,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_isn,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'kelulusan' => GeneralLabel::kelulusan,
            'muat_naik' => GeneralLabel::muat_naik,
            'kategori_atlet' => GeneralLabel::kategori_atlet,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
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
}
