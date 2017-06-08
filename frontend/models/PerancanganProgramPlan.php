<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_perancangan_program".
 *
 * @property integer $perancangan_program_id
 * @property string $tarikh_mula
 * @property string $nama_program
 * @property string $muat_naik
 */
class PerancanganProgramPlan extends \yii\db\ActiveRecord
{
    public $tarikh_dari, $tarikh_hingga;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perancangan_program_plan';
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
            [['tarikh_mula', 'tarikh_tamat', 'jenis_program', 'nama_program', 'bahagian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_kelulusan', 'status_program', 'sukan', 'cawangan', 'tarikh_jkk_jkp'], 'safe'],
            [['mesyuarat_id', 'status_permohonan', 'jenis_aktiviti'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_program', 'bilangan_jkk_jkp'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kelulusan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['anggaran_perbelanjaan', 'perbelanjaan_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['catatan', 'tempat'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['muat_naik'],'validateFileUpload', 'skipOnEmpty' => false],
/*             ['jenis_aktiviti', 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->bahagian != 1;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#perancanganprogramplan-bahagian').val() != '" . 1 . "';
                }"], */
/*             ['status_program', 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->bahagian == 1;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#perancanganprogramplan-bahagian').val() == '" . 1 . "';
                }"], */
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perancangan_program_id' => GeneralLabel::perancangan_program_id,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'nama_program' => GeneralLabel::nama_kenyataan,
            'jenis_program' => GeneralLabel::program,
            'lokasi' => GeneralLabel::tempat,
            'muat_naik' => GeneralLabel::muat_naik,
            'bahagian' => GeneralLabel::kategori,
            'cawangan' => GeneralLabel::cawangan,
            'jenis_aktiviti' => GeneralLabel::jenis,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'kelulusan' => GeneralLabel::kelulusan,
            //'status_program' => GeneralLabel::kedudukan_kejohanan,
			'status_program' => 'Rating',
            'sukan' => GeneralLabel::sukan,
            'bilangan_jkk_jkp' => GeneralLabel::bilangan_jkk_jkp,
            'tarikh_jkk_jkp' => GeneralLabel::tarikh_jkk_jkp,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'anggaran_perbelanjaan' => GeneralLabel::anggaran_perbelanjaan,
            'perbelanjaan_diluluskan' => GeneralLabel::perbelanjaan_diluluskan.' (RM)',
            'tempat' => GeneralLabel::tempat,
            'catatan' => GeneralLabel::catatan,
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
    /*public function getRefStatusProgram(){
        return $this->hasOne(RefStatusProgram::className(), ['id' => 'status_program']);
    }*/
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'jenis_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPelan(){
        return $this->hasOne(RefKategoriPelan::className(), ['id' => 'bahagian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisPelan(){
        return $this->hasOne(RefJenisPelan::className(), ['id' => 'jenis_aktiviti']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKedudukanKejohanan(){
        return $this->hasOne(RefKedudukanKejohanan::className(), ['id' => 'status_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanProgramBinaan()
    {
        return $this->hasOne(RefStatusPermohonanProgramBinaan::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerancanganProgramPlanMaster(){
        return $this->hasOne(PerancanganProgramPlanMaster::className(), ['perancangan_program_plan_master_id' => 'perancangan_program_plan_master_id']);
    }
}
