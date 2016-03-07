<?php

namespace app\models;

use Yii;

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
            'permohonan_pendidikan_id' => 'Permohonan Pendidikan ID',
            'jenis_permohonan' => 'Jenis Permohonan',
            'atlet_id' => 'Atlet',
            'no_ic' => 'No IC',
            'umur' => 'Umur',
            'jantina' => 'Jantina',
            'tinggi' => 'Tinggi',
            'berat' => 'Berat',
            'alamat_rumah_1' => 'Alamat Rumah',
            'alamat_rumah_2' => '',
            'alamat_rumah_3' => '',
            'alamat_rumah_negeri' => 'Negeri',
            'alamat_rumah_bandar' => 'Bandar',
            'alamat_rumah_poskod' => 'Poskod',
            'no_telefon_rumah' => 'No Telefon Rumah',
            'no_telefon_bimbit' => 'No Telefon Bimbit',
            'nama_ibu_bapa_penjaga' => 'Nama Ibu/Bapa/Penjaga',
            'tahap_pendidikan' => 'Tahap Pendidikan',
            'aliran' => 'Aliran',
            'keputusan_spm' => 'Keputusan SPM',
            'pilihan_aliran_spm' => 'Pilihan Aliran SPM',
            'sukan' => 'Sukan',
            'acara' => 'Acara',
            'tahun_program' => 'Tahun Program',
            'muat_naik' => 'Muat Naik',
            'catatan' => 'Catatan',
            'alamat_pendidikan_1' => 'Alamat Pendidikan',
            'alamat_pendidikan_2' => '',
            'alamat_pendidikan_3' => '',
            'alamat_pendidikan_negeri' => 'Negeri',
            'alamat_pendidikan_bandar' => 'Bandar',
            'alamat_pendidikan_poskod' => 'Poskod',
            'no_tel_pendidikan' => 'No Tel Pendidikan',
            'no_fax_pendidikan' => 'No Faks Pendidikan',
            'kelulusan' => 'Kelulusan',
            'nama_pencadang' => 'Nama Pencadang',
            'jawatan_pencadang' => 'Jawatan Pencadang',
            'no_telefon_pencadang' => 'No Telefon Pencadang',
            'sekolah_unit_sukan_pdd_psk_pencadang' => 'Sekolah/Unit Sukan/PDD/PSK Pencadang',
            'nama_pengesahan' => 'Nama Pengesahan',
            'jawatan_pengesahan' => 'Jawatan Pengesahan',
            'no_telefon_pengesahan' => 'No Telefon Pengesahan',
            'sekolah_unit_sukan_pdd_psk_pengesahan' => 'Sekolah/Unit Sukan/PDD/PSK Pengesahan',
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
