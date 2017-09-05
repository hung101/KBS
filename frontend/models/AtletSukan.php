<?php

namespace app\models;

use Yii;
use yii\web\Session;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\RefStatusTawaran;

/**
 * This is the model class for table "tbl_atlet_sukan".
 *
 * @property integer $sukan_id
 * @property integer $atlet_id
 * @property string $nama_sukan
 * @property string $acara
 * @property string $tahun_umur_permulaan
 * @property string $tarikh_mula_menyertai_program_msn
 * @property string $program_semasa
 * @property string $no_lesen_sukan
 * @property string $atlet_persekutuan_dunia_id
 */
class AtletSukan extends \yii\db\ActiveRecord
{
	public $athlete_status;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_sukan';
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
		$session = new Session;
        $session->open();
		
		if(isset($session['kelulusan_atlet']) && $session['kelulusan_atlet'] === RefStatusTawaran::LULUS_TAWARAN){
			$required = [['atlet_id', 'jurulatih_id', 'nama_sukan', 'acara', 'tarikh_mula_menyertai_program_msn', 'tarikh_tamat_menyertai_program_msn'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required];
		} else {
			$required = [['atlet_id'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required];
		}
		
        return [
            // [['atlet_id', 'jurulatih_id', 'nama_sukan', 'acara', 'tarikh_mula_menyertai_program_msn', 'tarikh_tamat_menyertai_program_msn'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
			$required,
            [['atlet_id', 'tahun_umur_permulaan', 'profil_pusat_latihan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula_menyertai_program_msn', 'cawangan', 'negeri_diwakili', 'status', 'tarikh_tamat_menyertai_program_msn', 
                'tarikh_kelulusan', 'source'], 'safe'],
            [['nama_sukan', 'acara', 'program_semasa'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_lesen_sukan', 'atlet_persekutuan_dunia_id'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kelulusan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_sukan', 'acara', 'program_semasa','no_lesen_sukan', 'atlet_persekutuan_dunia_id','kelulusan'], function ($attribute, $params) {
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
            'sukan_id' => GeneralLabel::sukan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'nama_sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'tahun_umur_permulaan' => GeneralLabel::tahun_umur_permulaan,
            'tarikh_mula_menyertai_program_msn' => GeneralLabel::tarikh_mula_lantikan,
            'tarikh_tamat_menyertai_program_msn' => GeneralLabel::tarikh_tamat_lantikan,
            'cawangan' => GeneralLabel::kumpulan_sukan,
            'program_semasa' => GeneralLabel::program,
            'no_lesen_sukan' => GeneralLabel::no_lesen_sukan,
            'atlet_persekutuan_dunia_id' => GeneralLabel::atlet_persekutuan_dunia_id,
            'negeri_diwakili' => GeneralLabel::negeri_diwakili,
            'status' => 'Mod Latihan',
            'kelulusan' => GeneralLabel::kelulusan,
            'source' => GeneralLabel::source,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'profil_pusat_latihan_id' => GeneralLabel::pusat_latihan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program_semasa']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawangan(){
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSource(){
        return $this->hasOne(RefSource::className(), ['id' => 'source']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusSukanAtlet(){
        return $this->hasOne(RefStatusSukanAtlet::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri_diwakili']);
    }
    
    public function getRefPusatLatihan()
    {
        return $this->hasOne(ProfilPusatLatihan::className(), ['profil_pusat_latihan_id' => 'profil_pusat_latihan_id']);
    }
}
