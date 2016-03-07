<?php

namespace app\models;

use Yii;

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
        return [
            [['nama_pemohon', 'bahagian', 'jawatan', 'destinasi', 'tarikh', 'nama_program', 'no_fail_kelulusan', 'bil_penumpang', 'aktiviti', 'sukan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['bil_penumpang', 'kelulusan'], 'integer'],
            [['nama_pemohon', 'jawatan', 'nama_program', 'aktiviti', 'atlet', 'jurulatih'], 'string', 'max' => 80],
            [['bahagian', 'sukan'], 'string', 'max' => 30],
            [['destinasi'], 'string', 'max' => 90],
            [['no_fail_kelulusan', 'kod_perbelanjaan'], 'string', 'max' => 20],
            [['pegawai_teknikal'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_kemudahan_ticket_kapal_terbang_id' => 'Permohonan Kemudahan Ticket Kapal Terbang ID',
            'nama_pemohon' => 'Nama Pemohon',
            'bahagian' => 'Bahagian',
            'jawatan' => 'Jawatan',
            'destinasi' => 'Destinasi',
            'tarikh' => 'Tarikh',
            'nama_program' => 'Nama Program',
            'no_fail_kelulusan' => 'No Fail Kelulusan',
            'bil_penumpang' => 'Bil. Penumpang',
            'aktiviti' => 'Aktiviti',
            'kod_perbelanjaan' => 'Kod Perbelanjaan',
            'sukan' => 'Sukan',
            'atlet' => 'Atlet',
            'jurulatih' => 'Jurulatih',
            'pegawai_teknikal' => 'Pegawai Teknikal',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram(){
        return $this->hasOne(RefProgram::className(), ['id' => 'nama_program']);
    }
}
