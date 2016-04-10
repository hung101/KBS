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
            [['nama_pemohon', 'bahagian', 'jawatan', 'destinasi', 'tarikh', 'nama_program', 'no_fail_kelulusan', 'bil_penumpang', 'aktiviti', 'sukan', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh'], 'safe'],
            [['bil_penumpang', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_pemohon', 'jawatan', 'nama_program', 'aktiviti', 'atlet', 'jurulatih'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bahagian', 'sukan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['destinasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_fail_kelulusan', 'kod_perbelanjaan'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai_teknikal'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
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
            'destinasi' => GeneralLabel::destinasi,
            'tarikh' => GeneralLabel::tarikh,
            'nama_program' => GeneralLabel::nama_program,
            'no_fail_kelulusan' => GeneralLabel::no_fail_kelulusan,
            'bil_penumpang' => GeneralLabel::bil_penumpang,
            'aktiviti' => GeneralLabel::aktiviti,
            'kod_perbelanjaan' => GeneralLabel::kod_perbelanjaan,
            'sukan' => GeneralLabel::sukan,
            'atlet' => GeneralLabel::atlet,
            'jurulatih' => GeneralLabel::jurulatih,
            'pegawai_teknikal' => GeneralLabel::pegawai_teknikal,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgram(){
        return $this->hasOne(RefProgram::className(), ['id' => 'nama_program']);
    }
}
