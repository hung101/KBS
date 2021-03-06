<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;
use yii\web\UploadedFile;
use app\models\general\Upload;

/**
 * This is the model class for table "tbl_pengurusan_permohonan_kursus_persatuan".
 *
 * @property integer $pengurusan_permohonan_kursus_persatuan_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $emel
 * @property string $facebook
 * @property string $kelayakan_akademi
 * @property string $perkerjaan
 * @property string $nama_majikan
 * @property string $yuran_program
 * @property integer $kelulusan
 */
class PengurusanPermohonanKursusPersatuan extends \yii\db\ActiveRecord
{
    public $kelulusan_id;
    public $memo;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_permohonan_kursus_persatuan';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_poskod', 'no_tel_bimbit', 
                'kelayakan_akademi', 'perkerjaan', 'nama_majikan', 'yuran_program', 'agensi', 'kursus', 'tahap',
                'tarikh_kursus', 'tarikh_tamat_kursus', 'tempat', 'no_perhubungan', 'bilangan_peserta', 'jumlah_yuran', 'nama_penganjur',
                'emel', 'kelulusan', 'kod_kursus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_lahir', 'tarikh_kursus', 'tarikh_tamat_kursus', 'tarikh_kelulusan', 'tarikh_permohonan'], 'safe'],
            [['yuran_program', 'jumlah_yuran', 'jumlah_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kelulusan', 'tahap', 'bilangan_peserta', 'no_perhubungan', 'kelulusan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama', 'kelayakan_akademi', 'perkerjaan', 'nama_majikan', 'agensi', 'kursus', 'nama_penganjur', 'jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['jantina'], 'string', 'max' => 1, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri', 'kod_kursus'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod','no_tel_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel_bimbit', 'no_perhubungan'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel', 'facebook'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'surat_permohonan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['memo'], 'string', 'max' => 500, 'tooLong' => GeneralMessage::yii_validation_string_max],
            ['tarikh_kursus','validateBeforePengurusan', 'on' => 'create'],
            [['surat_permohonan'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['alamat_1', 'alamat_2', 'alamat_3','tempat','alamat_negeri', 'kod_kursus','alamat_bandar','emel', 'facebook',
               'catatan','memo' ], function ($attribute, $params) {
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
            'pengurusan_permohonan_kursus_persatuan_id' => GeneralLabel::pengurusan_permohonan_kursus_persatuan_id,
            'nama' => GeneralLabel::nama_penyelaras,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'jantina' => GeneralLabel::jantina,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_pejabat,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'kelayakan_akademi' => GeneralLabel::kelayakan_akademi,
            'perkerjaan' => GeneralLabel::perkerjaan,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'yuran_program' => GeneralLabel::yuran_program,
            'kelulusan' => GeneralLabel::status_permohonan,
            'agensi' => GeneralLabel::agensi,
            'kursus' => GeneralLabel::kursus,
            'tahap' => GeneralLabel::tahap,
            'tarikh_kursus' => GeneralLabel::tarikh_mula_kursus,
            'tarikh_tamat_kursus' => GeneralLabel::tarikh_tamat_kursus,
            'tempat' => GeneralLabel::tempat,
            'no_perhubungan' => GeneralLabel::no_tel_bimbit,
            'bilangan_peserta' => GeneralLabel::bilangan_peserta,
            'jumlah_yuran' => GeneralLabel::jumlah_yuran,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'jumlah_diluluskan' => GeneralLabel::jumlah_diluluskan,
            'catatan' => GeneralLabel::catatan,
            'jawatan' => GeneralLabel::jawatan,
            'surat_permohonan' => GeneralLabel::surat_permohonan_rasmi,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,  //'Tarikh Permohonan',
            'memo' => '',
        ];
    }
	
    public function validateBeforePengurusan(){
        $dateMinus = new \DateTime($this->tarikh_kursus);
        $dateMinus->modify('-60 days'); // 60 days before tarikh mula kursus

        if($dateMinus->format('Y-m-d') <= GeneralFunction::getCurrentDate()){
            $this->addError('tarikh_kursus','Tarikh mula kursus tidak boleh kurang 60 hari dari tarikh hari ini');
        }
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
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanJkk(){
        return $this->hasOne(RefStatusPermohonanJkk::className(), ['id' => 'kelulusan']);
    }
}
