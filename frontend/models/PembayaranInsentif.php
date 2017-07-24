<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_insentif".
 *
 * @property integer $pembayaran_insentif_id
 * @property string $kejohanan
 * @property integer $jenis_insentif
 * @property integer $pingat
 * @property integer $kumpulan_temasya_kejohanan
 * @property integer $rekod_baharu
 * @property string $jumlah
 * @property string $kelulusan
 * @property string $tarikh_kelulusan
 * @property string $tarikh_pembayaran_insentif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranInsentif extends \yii\db\ActiveRecord
{
    public $acara_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_insentif';
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
            [['jenis_insentif', 'pingat', 'kumpulan_temasya_kejohanan', 'rekod_baharu', 'kejohanan', 'nama_kejohanan', 'peringkat', 'sukan',
                'acara'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jenis_insentif', 'pingat', 'kumpulan_temasya_kejohanan', 'rekod_baharu', 'created_by', 'updated_by', 'kelulusan', 'acara_id'], 'integer'],
            [['jumlah', 'nilai_rekod_baharu', 'nilai_sikap'], 'number'],
            [['tarikh_kelulusan', 'tarikh_pembayaran_insentif', 'created', 'updated', 'kelas', 'tarikh_mula', 'tarikh_tamat', 'persatuan'], 'safe'],
            [['kejohanan'], 'string', 'max' => 100],
            [['catatan', 'catatan_atlet', 'catatan_jurulatih', 'catatan_persatuan'], 'string', 'max' => 255],
            [['tempat'], 'string', 'max' => 90],
            [['no_vaucer'], 'string', 'max' => 80],
            ['kelas', 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return $model->kejohanan == RefInsentifKejohanan::INDIVIDU;
                }, 'whenClient' => "function (attribute, value) {
                    return $('#pembayaraninsentif-kejohanan').val() == '" . RefInsentifKejohanan::INDIVIDU . "';
                }"],
            /*[['nilai_sikap', 'persatuan'], 'required', 'message' => GeneralMessage::yii_validation_required, 'when' => function ($model) {
                    return ($model->acara == RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG || $model->acara == RefAcaraInsentif::BERPASUKAN_LEBIH_5_ORANG);
                }, 'whenClient' => "function (attribute, value) {
                    return ($('#pembayaraninsentif-acara').val() == '" . RefAcaraInsentif::BERPASUKAN_KURANG_5_ORANG . "' || $('#pembayaraninsentif-acara').val() == '" . RefAcaraInsentif::BERPASUKAN_LEBIH_5_ORANG . "');
                }"],*/
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_insentif_id' => 'Pembayaran Insentif ID',
            'kejohanan' => GeneralLabel::kejohanan,
            'jenis_insentif' => GeneralLabel::jenis_insentif,
            'pingat' => GeneralLabel::pingat,
            'kumpulan_temasya_kejohanan' => GeneralLabel::kumpulan_temasya_kejohanan,
            'rekod_baharu' => GeneralLabel::rekod_baharu,
            'jumlah' => GeneralLabel::nilai,
            'kelulusan' => GeneralLabel::kelulusan,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'tarikh_pembayaran_insentif' => GeneralLabel::tarikh_pembayaran_insentif,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'nama_kejohanan' => GeneralLabel::nama_kejohanan,
            'peringkat' => GeneralLabel::peringkat,
            'sukan' => GeneralLabel::sukan,
            'tempat' => GeneralLabel::tempat,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'persatuan' => GeneralLabel::persatuan,
            'nilai_sikap' => GeneralLabel::nilai,
            'nilai_rekod_baharu' => GeneralLabel::rekod_baharu_RM,
            'muat_naik' => GeneralLabel::muat_naik,
            'catatan' => GeneralLabel::catatan,
            'acara' => GeneralLabel::acara,
            'catatan_atlet' => GeneralLabel::catatan,
            'catatan_jurulatih' => GeneralLabel::catatan,
            'catatan_persatuan' => GeneralLabel::catatan,
            'no_vaucer' => GeneralLabel::no_vaucer,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisInsentif(){
        return $this->hasOne(RefJenisInsentif::className(), ['id' => 'jenis_insentif']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPingatInsentif(){
        return $this->hasOne(RefPingatInsentif::className(), ['id' => 'pingat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanInsentifTetapanShakamShakar(){
        return $this->hasOne(PengurusanInsentifTetapanShakamShakar::className(), ['pengurusan_insentif_tetapan_shakam_shakar_id' => 'kumpulan_temasya_kejohanan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusanInsentif::className(), ['id' => 'kelulusan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPembayaranInsentifAtlet(){
        return $this->hasMany(PembayaranInsentifAtlet::className(), ['pembayaran_insentif_id' => 'pembayaran_insentif_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerancanganProgram(){
        return $this->hasOne(PerancanganProgramPlan::className(), ['perancangan_program_id' => 'nama_kejohanan']);
    }
}
