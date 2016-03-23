<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['tarikh_pelantikan_jkk_jkp', 'tempoh_hak_jkk_jkp', 'status', 'nama_pegawai_coach', 'jawatan', 'tarikh_pelantikan', 'tempoh_hak', 'sukan', 'status_pilihan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_pelantikan_jkk_jkp', 'tarikh_pelantikan'], 'safe'],
            [['tempoh_hak_jkk_jkp', 'tempoh_hak', 'status_pilihan', 'jenis_cawangan_kuasa'], 'integer'],
            [['nama_setiausaha_jkk_jkp', 'nama_pegawai_coach', 'jawatan', 'sukan', 'nama_atlet', 'nama_jurulatih'], 'string', 'max' => 80],
            [['status', 'peranan'], 'string', 'max' => 30],
            [['agensi', 'jawatan_agensi'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jkk_jkp_id' => GeneralLabel::pengurusan_jkk_jkp_id,
            'jenis_cawangan_kuasa' => GeneralLabel::jenis_cawangan_kuasa,
            'nama_setiausaha_jkk_jkp' => GeneralLabel::nama_setiausaha_jkk_jkp,
            'tarikh_pelantikan_jkk_jkp' => GeneralLabel::tarikh_pelantikan_jkk_jkp,
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
            'nama_acara' => GeneralLabel::nama_acara,
            'nama_atlet' => GeneralLabel::nama_atlet,
            'status_pilihan' => GeneralLabel::status_pilihan,
            'nama_jurulatih' => GeneralLabel::nama_jurulatih,

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
}
