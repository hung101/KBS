<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

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
            [['perkhidmatan', 'tarikh', 'pegawai_yang_bertanggungjawab', 'status_ujian'], 'required', 'skipOnEmpty' => true],
            [['permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id'], 'integer'],
            [['tarikh'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['status_ujian'], 'string', 'max' => 30],
            [['catitan_ringkas'], 'string', 'max' => 255],
            [['muat_naik_video'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perkhidmatan_analisa_perlawanan_biomekanik_id' => 'Perkhidmatan Analisa Perlawanan Biomekanik ID',
            'permohonan_perkhidmatan_analisa_perlawanan_dan_bimekanik_id' => 'Permohonan Perkhidmatan Analisa Perlawanan Dan Bimekanik ID',
            'perkhidmatan' => 'Perkhidmatan',
            'tarikh' => 'Tarikh',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'status_ujian' => 'Status Ujian',
            'catitan_ringkas' => 'Catitan Ringkas',
            'muat_naik_video' => 'Muat Naik Video',
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
    
    public function getRefPerkhidmatanBiomekanik()
    {
        return $this->hasOne(RefPerkhidmatanBiomekanik::className(), ['id' => 'perkhidmatan']);
    }
}
