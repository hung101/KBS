<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_penyelidikan".
 *
 * @property integer $permohonana_penyelidikan_id
 * @property string $nama_permohon
 * @property string $tarikh_permohonan
 * @property string $tajuk_penyelidikan
 * @property string $ringkasan_permohonan
 * @property integer $biasa_dengan_keperluan_penyelidikan
 * @property integer $kelulusan_echics
 * @property integer $kelulusan
 */
class PermohonanPenyelidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_penyelidikan';
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
            [['nama_permohon', 'tarikh_permohonan', 'tajuk_penyelidikan', 'ringkasan_permohonan', 'biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan', 'jenis_projek'], 'required', 'skipOnEmpty' => true],
            [['tarikh_permohonan', 'tarikh_direkodkan', 'akademik_tarikh_pelantikan_pertama', 'akademik_kontrak_tarikh_tamat'], 'safe'],
            [['biasa_dengan_keperluan_penyelidikan', 'kelulusan_echics', 'kelulusan', 'jenis_projek', 'akademik_jenis_perkhidmatan', 'akademik_kursus'], 'integer'],
            [['nama_permohon', 'tajuk_penyelidikan', 'akademik_nama', 'akademik_nama_yang_dicadangkan'], 'string', 'max' => 80],
            [['ringkasan_permohonan'], 'string', 'max' => 255],
            [['isnrp_no', 'akademik_no_kakitangan'], 'string', 'max' => 30],
            [['akademik_ic_no'], 'string', 'max' => 12],
            [['akademik_no_tel_bimbit'], 'string', 'max' => 14],
            [['akademik_emel'], 'string', 'max' => 100],
            [['akademik_dokumen_sokongan'],'validateFileUpload', 'skipOnEmpty' => false]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonana_penyelidikan_id' => GeneralLabel::permohonana_penyelidikan_id,
            'nama_permohon' => GeneralLabel::nama_permohon,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'tajuk_penyelidikan' => GeneralLabel::tajuk_penyelidikan,
            'ringkasan_permohonan' => GeneralLabel::ringkasan_permohonan,
            'biasa_dengan_keperluan_penyelidikan' => GeneralLabel::biasa_dengan_keperluan_penyelidikan,
            'kelulusan_echics' => GeneralLabel::kelulusan_echics,
            'kelulusan' => GeneralLabel::kelulusan,
            'jenis_projek' => GeneralLabel::jenis_projek,
            'isnrp_no' => GeneralLabel::isnrp_no,
            'tarikh_direkodkan' => GeneralLabel::tarikh_direkod,
            'akademik_nama' => GeneralLabel::nama,
            'akademik_ic_no' => GeneralLabel::no_ic,
            'akademik_no_kakitangan' => GeneralLabel::no_kakitangan,
            'akademik_tarikh_pelantikan_pertama' => GeneralLabel::tarikh_pelantikan_pertama_isn,
            'akademik_jenis_perkhidmatan' => GeneralLabel::jenis_perkhidmatan,
            'akademik_kontrak_tarikh_tamat' => GeneralLabel::kontrak_tarikh_tamat,
            'akademik_no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'akademik_emel' => GeneralLabel::emel,
            'akademik_nama_yang_dicadangkan' => GeneralLabel::nama_yang_dicadangkan,
            'akademik_kursus' => GeneralLabel::kursus,
            'akademik_dokumen_sokongan' => GeneralLabel::dokumen_sokongan,
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
}
