<?php

namespace app\models;

use Yii;

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
            'pengurusan_jkk_jkp_id' => 'Pengurusan JKK/JKP ID',
            'jenis_cawangan_kuasa' => 'Jenis Cawangan Kuasa',
            'nama_setiausaha_jkk_jkp' => 'Nama Setiausaha JKK/JKP',
            'tarikh_pelantikan_jkk_jkp' => 'Tarikh Pelantikan JKK/JKP',
            'tempoh_hak_jkk_jkp' => 'Tempoh Hak JKK/JKP',
            'status' => 'Status',
            'nama_pegawai_coach' => 'Nama Ahli',
            'jawatan' => 'Jawatan',
            'tarikh_pelantikan' => 'Tarikh Pelantikan',
            'tempoh_hak' => 'Tempoh Hak',
            'peranan' => 'Peranan (JKK/JKP)',
            'agensi' => 'Agensi',
            'jawatan_agensi' => 'Jawatan (Agensi)',
            'sukan' => 'Sukan',
            'nama_acara' => 'Nama Acara',
            'nama_atlet' => 'Nama Atlet',
            'status_pilihan' => 'Status Pilihan',
            'nama_jurulatih' => 'Nama Jurulatih',
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
