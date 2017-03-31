<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_kemudahan_ticket_kapal_terbang".
 *
 * @property integer $permohonan_kemudahan_ticket_kapal_terbang_id
 * @property string $nama_pemohon
 * @property string $bahagian
 * @property string $jawatan
 * @property string $destinasi
 * @property string $tarikh
 * @property string $nama_program
 * @property string $no_fail_kelulusan
 * @property integer $bil_penumpang
 * @property string $aktiviti
 * @property string $kod_perbelanjaan
 * @property string $sukan
 * @property string $atlet
 * @property string $jurulatih
 * @property string $pegawai_teknikal
 * @property integer $kelulusan
 * @property integer $catatan
 */
class PermohonanKemudahanTicketKapalTerbang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_kemudahan_ticket_kapal_terbang';
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
        $rules = [
            [['nama_pemohon', 'jawatan', 'sukan', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tarikh_jkb', 'pulang', 'tarikh_pergi_2', 'tarikh_pergi_3', 'tarikh_pulang_2', 'tarikh_pulang_3', 'jurulatih', 'atlet', 'sukan', 'pri_tarikh_pergi', 'pri_tarikh_balik'], 'safe'],
            [['bil_penumpang', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_pemohon', 'jawatan', 'nama_program', 'aktiviti', 'cawangan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bahagian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bilangan_jkb', 'pri_flight_pergi', 'pri_flight_balik'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['destinasi', 'tarikh_ke', 'pulang_tarikh_dari', 'pulang_tarikh_ke', 'dari_pergi_2', 'ke_pergi_2', 'dari_pergi_3', 'ke_pergi_3', 'dari_pulang_2', 'ke_pulang_2',
                'dari_pulang_3', 'ke_pulang_3'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_fail_kelulusan', 'kod_perbelanjaan', 'pri_masa_pergi', 'pri_masa_balik'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai_teknikal', 'catatan', 'pri_destinasi_pergi', 'pri_destinasi_balik'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
        
        if(!isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-kemudahan-ticket-kapal-terbang']['psk'])){
            // if not PSK, Bahagian must be mandatory
            $rules[] = [['bahagian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required];
        }
        
        return $rules;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_kemudahan_ticket_kapal_terbang_id' => GeneralLabel::permohonan_kemudahan_ticket_kapal_terbang_id,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'bahagian' => GeneralLabel::bahagian,
            'jawatan' => GeneralLabel::jawatan,
            'destinasi' => GeneralLabel::dari,
            'tarikh' => GeneralLabel::tarikh,
            'tarikh_ke' => GeneralLabel::ke,
            'nama_program' => GeneralLabel::kejohanan,
            'no_fail_kelulusan' => GeneralLabel::no_fail_kelulusan,
            'bil_penumpang' => GeneralLabel::bil_penumpang,
            'aktiviti' => GeneralLabel::aktiviti,
            'kod_perbelanjaan' => GeneralLabel::kod_perbelanjaan,
            'sukan' => GeneralLabel::sukan,
            'atlet' => GeneralLabel::atlet,
            'jurulatih' => GeneralLabel::jurulatih,
            'pegawai_teknikal' => GeneralLabel::pegawai,
            'kelulusan' => GeneralLabel::status_permohonan,
            'pulang' => GeneralLabel::tarikh,
            'pulang_tarikh_dari' => GeneralLabel::dari,
            'pulang_tarikh_ke' => GeneralLabel::ke,
            'cawangan' => GeneralLabel::cawangan,
            'bilangan_jkb' => GeneralLabel::bilangan_jkb,
            'tarikh_jkb' => GeneralLabel::tarikh_jkb,
            'tarikh_pergi_2' => GeneralLabel::tarikh,
            'dari_pergi_2' => GeneralLabel::dari,
            'ke_pergi_2' => GeneralLabel::ke,
            'tarikh_pergi_3' => GeneralLabel::tarikh,
            'dari_pergi_3' => GeneralLabel::dari,
            'ke_pergi_3' => GeneralLabel::ke,
            'tarikh_pulang_2' => GeneralLabel::tarikh,
            'dari_pulang_2' => GeneralLabel::dari,
            'ke_pulang_2' => GeneralLabel::ke,
            'tarikh_pulang_3' => GeneralLabel::tarikh,
            'dari_pulang_3' => GeneralLabel::dari,
            'ke_pulang_3' => GeneralLabel::ke,
            'catatan' => GeneralLabel::catatan,
            'pri_tarikh_pergi' => GeneralLabel::tarikh,
            'pri_flight_pergi' => GeneralLabel::flight_no,
            'pri_masa_pergi' => GeneralLabel::masa,
            'pri_destinasi_pergi' => GeneralLabel::destinasi,
            'pri_tarikh_balik' => GeneralLabel::tarikh,
            'pri_flight_balik' => GeneralLabel::flight_no,
            'pri_masa_balik' => GeneralLabel::masa,
            'pri_destinasi_balik' => GeneralLabel::destinasi,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram(){
        //return $this->hasOne(RefProgram::className(), ['id' => 'nama_program']);
        return $this->hasOne(PerancanganProgramPlan::className(), ['perancangan_program_id' => 'nama_program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBahagianKemudahan(){
        //return $this->hasOne(RefBahagianKemudahan::className(), ['id' => 'bahagian']);
        return $this->hasOne(RefBahagianAduan::className(), ['id' => 'bahagian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawanganKemudahan(){
        //return $this->hasOne(RefCawanganKemudahan::className(), ['id' => 'cawangan']);
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
}
