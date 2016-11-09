<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan".
 *
 * @property integer $pengurusan_program_binaan_id
 * @property string $nama_ppn
 * @property string $pengurus_pn
 * @property string $kategori_permohonan
 * @property string $jenis_permohonan
 * @property string $sukan
 * @property string $tempat
 * @property string $tahap
 * @property string $negeri
 * @property string $daerah
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property integer $sokongan_pn
 * @property integer $kelulusan
 */
class PengurusanProgramBinaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan';
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
            [['nama_program', 'kategori_permohonan', 'jenis_permohonan', 'tempat', 'tahap', 'daerah', 'tarikh_mula', 'tarikh_tamat', 
                'kelulusan', 'program', 'aktiviti', 'nama_aktiviti'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'tarikh_jkb'], 'safe'],
            [['sokongan_pn', 'kelulusan', 'status_permohonan', 'mesyuarat_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_yang_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['nama_ppn', 'pengurus_pn', 'sukan', 'bilangan_jkb', 'jabatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_permohonan', 'jenis_permohonan', 'tahap', 'negeri', 'jenis_aktiviti'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_program'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['daerah'], 'string', 'max' => 40, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_binaan_id' => GeneralLabel::pengurusan_program_binaan_id,
            'nama_program' => GeneralLabel::nama_program,
            'nama_ppn' => GeneralLabel::nama_ppn,
            'pengurus_pn' => GeneralLabel::pengurus_pn,
            'kategori_permohonan' => GeneralLabel::kategori_permohonan,
            'jenis_permohonan' => GeneralLabel::jenis_permohonan,
            'sukan' => GeneralLabel::sukan,
            'tempat' => GeneralLabel::tempat,
            'tahap' => GeneralLabel::tahap,
            'negeri' => GeneralLabel::negeri,
            'daerah' => GeneralLabel::daerah,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'sokongan_pn' => 'Sokongan Bahagian Atlet',
            'kelulusan' => GeneralLabel::kelulusan,
            'aktiviti' => GeneralLabel::nama_program,
            'jumlah_yang_diluluskan' => GeneralLabel::jumlah_yang_diluluskan,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'jenis_aktiviti ' => GeneralLabel::jenis_aktiviti,
            'jabatan' => GeneralLabel::jabatan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPermohonan(){
        return $this->hasOne(RefKategoriPermohonanProgramBinaan::className(), ['id' => 'kategori_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisPermohonan(){
        return $this->hasOne(RefJenisPermohonanProgramBinaan::className(), ['id' => 'jenis_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSokongPn()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'sokongan_pn'])->from(['rk1' => RefKelulusan::tableName()]);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusanProgramBinaan()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan'])->from(['rk2' => RefKelulusan::tableName()]);
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
    public function getRefPerancanganProgram()
    {
        return $this->hasOne(PerancanganProgram::className(), ['perancangan_program_id' => 'aktiviti']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanProgramBinaanPeserta()
    {
        return $this->hasMany(PengurusanProgramBinaanPeserta::className(), ['pengurusan_program_binaan_id' => 'pengurusan_program_binaan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanProgramBinaanAtlet(){
        return $this->hasMany(PengurusanProgramBinaanAtlet::className(), ['pengurusan_program_binaan_id' => 'pengurusan_program_binaan_id']);
    }
}
