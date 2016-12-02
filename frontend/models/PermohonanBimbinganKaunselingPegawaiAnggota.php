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
            [['no_telefon', 'no_tel_pegawai', 'no_kad_pengenalan', 'no_kad_pengenalan_pegawai'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
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
            'nama' => GeneralLabel::nama,  //'Nama',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'no_fail_pekerja' => GeneralLabel::no_fail_pekerja,  //'No Fail Pekerja',
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,  //'No Kad Pengenalan',
            'umur' => GeneralLabel::umur,  //'Umur',
            'no_telefon' => GeneralLabel::no_telefon,  //'No Tel',
            'emel' => GeneralLabel::emel,  //'Emel',
            'bahagian' => GeneralLabel::bahagian,  //'Bahagian',
            'taraf_perkahwinan' => GeneralLabel::taraf_perkahwinan,  //'Taraf Perkahwinan',
            'status_jawatan' => GeneralLabel::status_jawatan,  //'Status Jawatan',
            'jantina' => GeneralLabel::jantina,  //'Jantina',
            'tarikh_temujanji' => GeneralLabel::tarikh_temujanji,  //'Tarikh Temujanji',
            'kategori_masalah' => GeneralLabel::kategori_masalah,  //'Kategori Masalah',
            'catatan_kaunselor' => GeneralLabel::catatan_kaunselor,  //Catatan Kaunselor',
            'tindakan_kaunselor' => GeneralLabel::tindakan_kaunselor,  //'Tindakan Kaunselor',
            'cadangan_kaunselor' => GeneralLabel::cadangan_kaunselor,  //'Cadangan Kaunselor',
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,  //'Tarikh Permohonan',
            'status_permohonan' => GeneralLabel::status_permohonan,  //'Status Permohonan',
            'catatan_permohonan' => GeneralLabel::catatan_permohonan,  //'Catatan Permohonan',
            'nama_pegawai_anggota' => GeneralLabel::nama_pegawai,  //'Nama Pegawai / Anggota',
            'no_kad_pengenalan_pegawai' => GeneralLabel::no_kad_pengenalan,  //'No Kad Pengenalan',
            'umur_pegawai' => GeneralLabel::umur,  //'Umur',
            'jawatan_pegawai' => GeneralLabel::jawatan,  //'Jawatan',
            'no_fail_pekerja_pegawai' => GeneralLabel::no_fail_pekerja,  //'No Fail Pekerja',
            'bahagian_pegawai' => GeneralLabel::bahagian,  //'Bahagian',
            'no_tel_pegawai' => GeneralLabel::no_tel,  //'No Tel',
            'emel_pegawai' => GeneralLabel::emel,  //'Emel',
            'taraf_perkahwinan_pegawai' => GeneralLabel::taraf_perkahwinan,  //'Taraf Perkahwinan',
            'status_jawatan_pegawai' => GeneralLabel::status_jawatan,  //'Status Jawatan',
            'jantina_pegawai' => GeneralLabel::jantina,  //'Jantina',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
