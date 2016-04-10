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
            [['nama_program', 'kategori_permohonan', 'jenis_permohonan', 'sukan', 'tempat', 'tahap', 'negeri', 'daerah', 'tarikh_mula', 'tarikh_tamat', 'sokongan_pn', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['sokongan_pn', 'kelulusan'], 'integer'],
            [['nama_ppn', 'pengurus_pn', 'sukan'], 'string', 'max' => 80],
            [['kategori_permohonan', 'jenis_permohonan', 'tahap', 'negeri'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 90],
            [['nama_program'], 'string', 'max' => 100],
            [['daerah'], 'string', 'max' => 40]
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
            'sokongan_pn' => GeneralLabel::sokongan_pn,
            'kelulusan' => GeneralLabel::kelulusan,

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
}
