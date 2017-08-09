<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_jkk_jkp".
 *
 * @property integer $pengurusan_jkk_jkp_id
 * @property string $nama_setiausaha_jkk_jkp
 * @property string $tarikh_pelantikan_jkk_jkp
 * @property integer $tempoh_hak_jkk_jkp
 * @property string $status
 * @property string $nama_pegawai_coach
 * @property string $jawatan
 * @property string $tarikh_pelantikan
 * @property integer $tempoh_hak
 * @property string $sukan
 * @property string $nama_acara
 * @property string $nama_atlet
 * @property integer $status_pilihan
 * @property string $nama_jurulatih
 */
class PengurusanJkkJkp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jkk_jkp';
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
            [['tarikh_pelantikan_jkk_jkp', 'tempoh_hak_jkk_jkp', 'status', 'nama_pegawai_coach', 'jawatan', 'sukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_pelantikan_jkk_jkp', 'tarikh_pelantikan'], 'safe'],
            [['tempoh_hak_jkk_jkp', 'tempoh_hak', 'status_pilihan', 'jenis_cawangan_kuasa', 'sukan', 'cawangan', 'bahagian'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_setiausaha_jkk_jkp', 'nama_pegawai_coach', 'jawatan', 'nama_atlet', 'nama_jurulatih'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status', 'peranan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['agensi', 'jawatan_agensi', 'peranan_lain'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['nama_setiausaha_jkk_jkp', 'nama_pegawai_coach', 'jawatan', 'nama_atlet', 'nama_jurulatih','status', 'peranan','agensi', 
                'jawatan_agensi', 'peranan_lain','emel'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_jkk_jkp_id' => GeneralLabel::pengurusan_jkk_jkp_id,
            'jenis_cawangan_kuasa' => GeneralLabel::jenis_mesyuarat,
            'nama_setiausaha_jkk_jkp' => GeneralLabel::nama_setiausaha_jkk_jkp,
            'tarikh_pelantikan_jkk_jkp' => GeneralLabel::tarikh_jkk_jkp,
            'tempoh_hak_jkk_jkp' => GeneralLabel::tempoh_hak_jkk_jkp,
            'status' => GeneralLabel::status,
            'nama_pegawai_coach' => GeneralLabel::nama_pegawai_coach,
            'jawatan' => GeneralLabel::jawatan,
            'tarikh_pelantikan' => GeneralLabel::tarikh_pelantikan,
            'tempoh_hak' => GeneralLabel::tempoh_hak,
            'peranan' => GeneralLabel::peranan,
            'agensi' => GeneralLabel::agensi,
            'jawatan_agensi' => GeneralLabel::jawatan_agensi,
            'sukan' => GeneralLabel::sukan,
			'cawangan' => GeneralLabel::cawangan,
			'email' => GeneralLabel::emel,
			'bahagian' => GeneralLabel::bahagian,
            'nama_acara' => GeneralLabel::nama_acara,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'status_pilihan' => GeneralLabel::status_pilihan,
            'nama_jurulatih' => GeneralLabel::nama_jurulatih,
            'peranan_lain' => GeneralLabel::nyatakan_jika_lain_lain,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNamaAhliJkkJkp(){
        return $this->hasOne(RefNamaAhliJkkJkp::className(), ['id' => 'nama_pegawai_coach']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisCawanganKuasaJkkJkp(){
        return $this->hasOne(RefJenisCawanganKuasaJkkJkp::className(), ['id' => 'jenis_cawangan_kuasa']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusJkkJkp(){
        return $this->hasOne(RefStatusJkkJkp::className(), ['id' => 'status']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanJkkJkp(){
        return $this->hasOne(RefJawatanJkkJkp::className(), ['id' => 'jawatan']);
    }
}
