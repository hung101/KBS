<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_perkhidmatan_analisa_perlawanan_biomekanik".
 *
 * @property integer $perkhidmatan_analisa_perlawanan_biomekanik_id
 * @property integer $permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id
 * @property string $perkhidmatan
 * @property string $tarikh
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $status_ujian
 * @property string $catitan_ringkas
 */
class PerkhidmatanAnalisaPerlawananBiomekanik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perkhidmatan_analisa_perlawanan_biomekanik';
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
            [['perkhidmatan', 'tarikh', 'pegawai_yang_bertanggungjawab', 'status_ujian', 'sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id', 'atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_ujian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik_video'],'validateFileUpload', 'skipOnEmpty' => false],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab','status_ujian','catitan_ringkas'], 'filter', 'filter' => function ($value) {
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
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => GeneralLabel::perkhidmatan_analisa_perlawanan_biomekanik_id,
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => GeneralLabel::permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'tarikh' => GeneralLabel::tarikh,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'status_ujian' => GeneralLabel::status_ujian,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'muat_naik_video' => GeneralLabel::muat_naik_video,
            'atlet_id' => GeneralLabel::atlet,
            'sukan' => GeneralLabel::sukan,
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
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    public function getRefPerkhidmatanBiomekanik()
    {
        return $this->hasOne(RefPerkhidmatanBiomekanik::className(), ['id' => 'perkhidmatan']);
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
