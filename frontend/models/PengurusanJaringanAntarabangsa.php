<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_jaringan_antarabangsa".
 *
 * @property integer $pengurusan_jaringan_antarabangsa_id
 * @property string $nama_badan_sukan
 * @property string $negara
 * @property string $nama_pemohon
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $pegawai_teknikal
 * @property string $permohonan
 * @property string $jenis_program
 * @property string $no_telefon
 * @property string $no_tel_bimbit
 * @property string $no_faks
 * @property string $emel
 * @property string $nama_majikan
 * @property string $alamat_majikan_1
 * @property string $alamat_majikan_2
 * @property string $alamat_majikan_3
 * @property string $alamat_majikan_negeri
 * @property string $alamat_majikan_bandar
 * @property string $alamat_majikan_poskod
 * @property string $jawatan_di_persatuan
 * @property string $tahap_kelayakan_sekarang
 */
class PengurusanJaringanAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jaringan_antarabangsa';
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
            [['nama_badan_sukan', 'negara', 'nama_pemohon', 'no_kad_pengenalan', 'jantina', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'pegawai_teknikal', 'permohonan', 'jenis_program', 'no_telefon', 'no_tel_bimbit', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'jawatan_di_persatuan'], 'required', 'skipOnEmpty' => true],
            [['nama_badan_sukan', 'negara', 'nama_pemohon', 'pegawai_teknikal', 'permohonan', 'nama_majikan', 'jawatan_di_persatuan', 'tahap_kelayakan_sekarang'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3'], 'string', 'max' => 90],
            [['alamat_surat_menyurat_negeri', 'jenis_program', 'alamat_majikan_negeri'], 'string', 'max' => 30],
            [['alamat_surat_menyurat_bandar', 'alamat_majikan_bandar'], 'string', 'max' => 40],
            [['alamat_surat_menyurat_poskod', 'alamat_majikan_poskod'], 'string', 'max' => 5],
            [['no_telefon', 'no_tel_bimbit', 'no_faks'], 'string', 'max' => 14],
            [['emel'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jaringan_antarabangsa_id' => GeneralLabel::pengurusan_jaringan_antarabangsa_id,
            'nama_badan_sukan' => GeneralLabel::nama_badan_sukan,
            'negara' => GeneralLabel::negara,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'jantina' => GeneralLabel::jantina,
            'alamat_surat_menyurat_1' => GeneralLabel::alamat_surat_menyurat_1,
            'alamat_surat_menyurat_2' => GeneralLabel::alamat_surat_menyurat_2,
            'alamat_surat_menyurat_3' => GeneralLabel::alamat_surat_menyurat_3,
            'alamat_surat_menyurat_negeri' => GeneralLabel::alamat_surat_menyurat_negeri,
            'alamat_surat_menyurat_bandar' => GeneralLabel::alamat_surat_menyurat_bandar,
            'alamat_surat_menyurat_poskod' => GeneralLabel::alamat_surat_menyurat_poskod,
            'pegawai_teknikal' => GeneralLabel::pegawai_teknikal,
            'permohonan' => GeneralLabel::permohonan,
            'jenis_program' => GeneralLabel::jenis_program,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'no_faks' => GeneralLabel::no_faks,
            'emel' => GeneralLabel::emel,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'alamat_majikan_1' => GeneralLabel::alamat_majikan_1,
            'alamat_majikan_2' => GeneralLabel::alamat_majikan_2,
            'alamat_majikan_3' => GeneralLabel::alamat_majikan_3,
            'alamat_majikan_negeri' => GeneralLabel::alamat_majikan_negeri,
            'alamat_majikan_bandar' => GeneralLabel::alamat_majikan_bandar,
            'alamat_majikan_poskod' => GeneralLabel::alamat_majikan_poskod,
            'jawatan_di_persatuan' => GeneralLabel::jawatan_di_persatuan,
            'tahap_kelayakan_sekarang' => GeneralLabel::tahap_kelayakan_sekarang,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'negara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPemohonJaringanAntarabangsa(){
        return $this->hasOne(RefPemohonJaringanAntarabangsa::className(), ['id' => 'nama_pemohon']);
    }
}
