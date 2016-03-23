<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_pendidikan".
 *
 * @property integer $permohonan_pendidikan_id
 * @property integer $atlet_id
 * @property string $no_ic
 * @property integer $umur
 * @property string $jantina
 * @property string $tinggi
 * @property string $berat
 * @property string $alamat_rumah_1
 * @property string $alamat_rumah_2
 * @property string $alamat_rumah_3
 * @property string $alamat_rumah_negeri
 * @property string $alamat_rumah_bandar
 * @property string $alamat_rumah_poskod
 * @property string $no_telefon_rumah
 * @property string $no_telefon_bimbit
 * @property string $nama_ibu_bapa_penjaga
 * @property string $tahap_pendidikan
 * @property string $aliran
 * @property string $keputusan_spm
 * @property string $pilihan_aliran_spm
 * @property string $sukan
 * @property string $acara
 * @property string $tahun_program
 * @property string $muat_naik
 * @property string $catatan
 * @property string $alamat_pendidikan_1
 * @property string $alamat_pendidikan_2
 * @property string $alamat_pendidikan_3
 * @property string $alamat_pendidikan_negeri
 * @property string $alamat_pendidikan_bandar
 * @property string $alamat_pendidikan_poskod
 * @property string $no_tel_pendidikan
 * @property string $no_fax_pendidikan
 * @property integer $kelulusan
 * @property string $nama_pencadang
 * @property string $jawatan_pencadang
 * @property string $no_telefon_pencadang
 * @property string $sekolah_unit_sukan_pdd_psk_pencadang
 * @property string $nama_pengesahan
 * @property string $jawatan_pengesahan
 * @property string $no_telefon_pengesahan
 * @property string $sekolah_unit_sukan_pdd_psk_pengesahan
 */
class PermohonanPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_pendidikan';
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
            [['atlet_id', 'no_ic', 'umur', 'jantina', 'tinggi', 'berat', 'alamat_rumah_1', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 'no_telefon_rumah', 'no_telefon_bimbit', 'nama_ibu_bapa_penjaga', 'tahap_pendidikan', 'sukan', 'acara', 'alamat_pendidikan_1', 'alamat_pendidikan_negeri', 'alamat_pendidikan_bandar', 'alamat_pendidikan_poskod', 'no_tel_pendidikan', 'kelulusan', 'nama_pengesahan', 'jawatan_pengesahan', 'no_telefon_pengesahan', 'sekolah_unit_sukan_pdd_psk_pengesahan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'umur', 'kelulusan'], 'integer'],
            [['tinggi', 'berat', 'tahun_program'], 'number'],
            [['tahun_program', 'jenis_permohonan'], 'safe'],
            [['no_ic'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_pendidikan_1', 'alamat_pendidikan_2', 'alamat_pendidikan_3'], 'string', 'max' => 90],
            [['alamat_rumah_negeri', 'tahap_pendidikan', 'alamat_pendidikan_negeri'], 'string', 'max' => 30],
            [['alamat_rumah_bandar', 'alamat_pendidikan_bandar'], 'string', 'max' => 40],
            [['alamat_rumah_poskod', 'alamat_pendidikan_poskod'], 'string', 'max' => 5],
            [['no_telefon_rumah', 'no_telefon_bimbit', 'no_tel_pendidikan', 'no_fax_pendidikan', 'no_telefon_pencadang', 'no_telefon_pengesahan'], 'string', 'max' => 14],
            [['nama_ibu_bapa_penjaga', 'aliran', 'pilihan_aliran_spm', 'sukan', 'acara', 'nama_pencadang', 'jawatan_pencadang', 'sekolah_unit_sukan_pdd_psk_pencadang', 'nama_pengesahan', 'jawatan_pengesahan', 'sekolah_unit_sukan_pdd_psk_pengesahan'], 'string', 'max' => 80],
            [['keputusan_spm', 'catatan'], 'string', 'max' => 255],
            [['muat_naik'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_pendidikan_id' => GeneralLabel::permohonan_pendidikan_id,
            'jenis_permohonan' => GeneralLabel::jenis_permohonan,
            'atlet_id' => GeneralLabel::atlet_id,
            'no_ic' => GeneralLabel::no_ic,
            'umur' => GeneralLabel::umur,
            'jantina' => GeneralLabel::jantina,
            'tinggi' => GeneralLabel::tinggi,
            'berat' => GeneralLabel::berat,
            'alamat_rumah_1' => GeneralLabel::alamat_rumah_1,
            'alamat_rumah_2' => GeneralLabel::alamat_rumah_2,
            'alamat_rumah_3' => GeneralLabel::alamat_rumah_3,
            'alamat_rumah_negeri' => GeneralLabel::alamat_rumah_negeri,
            'alamat_rumah_bandar' => GeneralLabel::alamat_rumah_bandar,
            'alamat_rumah_poskod' => GeneralLabel::alamat_rumah_poskod,
            'no_telefon_rumah' => GeneralLabel::no_telefon_rumah,
            'no_telefon_bimbit' => GeneralLabel::no_telefon_bimbit,
            'nama_ibu_bapa_penjaga' => GeneralLabel::nama_ibu_bapa_penjaga,
            'tahap_pendidikan' => GeneralLabel::tahap_pendidikan,
            'aliran' => GeneralLabel::aliran,
            'keputusan_spm' => GeneralLabel::keputusan_spm,
            'pilihan_aliran_spm' => GeneralLabel::pilihan_aliran_spm,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'tahun_program' => GeneralLabel::tahun_program,
            'muat_naik' => GeneralLabel::muat_naik,
            'catatan' => GeneralLabel::catatan,
            'alamat_pendidikan_1' => GeneralLabel::alamat_pendidikan_1,
            'alamat_pendidikan_2' => GeneralLabel::alamat_pendidikan_2,
            'alamat_pendidikan_3' => GeneralLabel::alamat_pendidikan_3,
            'alamat_pendidikan_negeri' => GeneralLabel::alamat_pendidikan_negeri,
            'alamat_pendidikan_bandar' => GeneralLabel::alamat_pendidikan_bandar,
            'alamat_pendidikan_poskod' => GeneralLabel::alamat_pendidikan_poskod,
            'no_tel_pendidikan' => GeneralLabel::no_tel_pendidikan,
            'no_fax_pendidikan' => GeneralLabel::no_fax_pendidikan,
            'kelulusan' => GeneralLabel::kelulusan,
            'nama_pencadang' => GeneralLabel::nama_pencadang,
            'jawatan_pencadang' => GeneralLabel::jawatan_pencadang,
            'no_telefon_pencadang' => GeneralLabel::no_telefon_pencadang,
            'sekolah_unit_sukan_pdd_psk_pencadang' => GeneralLabel::sekolah_unit_sukan_pdd_psk_pencadang,
            'nama_pengesahan' => GeneralLabel::nama_pengesahan,
            'jawatan_pengesahan' => GeneralLabel::jawatan_pengesahan,
            'no_telefon_pengesahan' => GeneralLabel::no_telefon_pengesahan,
            'sekolah_unit_sukan_pdd_psk_pengesahan' => GeneralLabel::sekolah_unit_sukan_pdd_psk_pengesahan,

        ];
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
    public function getRefTahapPendidikan(){
        return $this->hasOne(RefTahapPendidikan::className(), ['id' => 'tahap_pendidikan']);
    }
}
