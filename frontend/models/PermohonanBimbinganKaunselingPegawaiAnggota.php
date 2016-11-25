<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_bimbingan_kaunseling_pegawai_anggota".
 *
 * @property integer $permohonan_bimbingan_kaunseling_pegawai_anggota_id
 * @property string $nama
 * @property string $jawatan
 * @property string $no_kad_pengenalan
 * @property integer $umur
 * @property string $no_telefon
 * @property string $emel
 * @property integer $bahagian
 * @property integer $taraf_perkahwinan
 * @property integer $status_jawatan
 * @property integer $jantina
 * @property string $tarikh_temujanji
 * @property integer $kategori_masalah
 * @property string $catatan_kaunselor
 * @property string $tindakan_kaunselor
 * @property string $cadangan_kaunselor
 * @property string $tarikh_permohonan
 * @property integer $status_permohonan
 * @property string $catatan_permohonan
 * @property string $nama_pegawai_anggota
 * @property string $no_kad_pengenalan_pegawai
 * @property integer $umur_pegawai
 * @property string $jawatan_pegawai
 * @property integer $bahagian_pegawai
 * @property string $no_tel_pegawai
 * @property string $emel_pegawai
 * @property integer $taraf_perkahwinan_pegawai
 * @property integer $status_jawatan_pegawai
 * @property integer $jantina_pegawai
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PermohonanBimbinganKaunselingPegawaiAnggota extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_bimbingan_kaunseling_pegawai_anggota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'jawatan', 'no_fail_pekerja', 'no_kad_pengenalan', 'umur', 'no_telefon', 'emel', 'bahagian', 'taraf_perkahwinan', 'status_jawatan', 'jantina',
                'tarikh_temujanji'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['umur', 'bahagian', 'taraf_perkahwinan', 'status_jawatan', 'jantina', 'kategori_masalah', 'status_permohonan', 'umur_pegawai', 'bahagian_pegawai', 'taraf_perkahwinan_pegawai', 'status_jawatan_pegawai', 'jantina_pegawai', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_temujanji', 'tarikh_permohonan', 'created', 'updated'], 'safe'],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['nama', 'jawatan', 'nama_pegawai_anggota', 'jawatan_pegawai'], 'string', 'max' => 80],
            [['no_kad_pengenalan', 'no_kad_pengenalan_pegawai'], 'string', 'max' => 12],
            [['no_telefon', 'no_tel_pegawai'], 'string', 'max' => 14],
            [['no_telefon', 'no_tel_pegawai'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_fail_pekerja_pegawai', 'no_fail_pekerja'], 'string', 'max' => 30],
            [['emel', 'emel_pegawai'], 'string', 'max' => 100],
            [['catatan_kaunselor', 'tindakan_kaunselor', 'cadangan_kaunselor', 'catatan_permohonan'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_bimbingan_kaunseling_pegawai_anggota_id' => 'Permohonan Bimbingan Kaunseling Pegawai Anggota ID',
            'nama' => 'Nama',
            'jawatan' => 'Jawatan',
            'no_fail_pekerja' => 'No Fail Pekerja',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'umur' => 'Umur',
            'no_telefon' => 'No Tel',
            'emel' => 'Emel',
            'bahagian' => 'Bahagian',
            'taraf_perkahwinan' => 'Taraf Perkahwinan',
            'status_jawatan' => 'Status Jawatan',
            'jantina' => 'Jantina',
            'tarikh_temujanji' => 'Tarikh Cadangan Temujanji',
            'kategori_masalah' => 'Kategori Masalah',
            'catatan_kaunselor' => 'Catatan Kaunselor',
            'tindakan_kaunselor' => 'Tindakan Kaunselor',
            'cadangan_kaunselor' => 'Cadangan Kaunselor',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'status_permohonan' => 'Status Permohonan',
            'catatan_permohonan' => 'Catatan Permohonan',
            'nama_pegawai_anggota' => 'Nama Pegawai / Anggota',
            'no_kad_pengenalan_pegawai' => 'No Kad Pengenalan',
            'umur_pegawai' => 'Umur',
            'jawatan_pegawai' => 'Jawatan',
            'no_fail_pekerja_pegawai' => 'No Fail Pekerja',
            'bahagian_pegawai' => 'Bahagian',
            'no_tel_pegawai' => 'No Tel',
            'emel_pegawai' => 'Emel',
            'taraf_perkahwinan_pegawai' => 'Taraf Perkahwinan',
            'status_jawatan_pegawai' => 'Status Jawatan',
            'jantina_pegawai' => 'Jantina',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
