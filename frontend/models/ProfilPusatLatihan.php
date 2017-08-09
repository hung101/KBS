<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_pusat_latihan".
 *
 * @property integer $profil_pusat_latihan_id
 * @property string $nama_pusat_latihan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_telefon
 * @property string $no_faks
 * @property string $emel
 * @property string $tarikh_program_bermula
 * @property string $tahun_siap_pembinaan
 * @property string $kos_project
 * @property string $keluasan_venue
 * @property string $hakmilik
 * @property string $kadar_sewaan
 * @property string $status
 * @property string $catatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilPusatLatihan extends \yii\db\ActiveRecord
{
    public $status_permohonan_id;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_pusat_latihan';
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
            [['sukan', 'program', 'nama_pusat_latihan', 'alamat_1', 'alamat_negeri', 'alamat_poskod',
                'hakmilik', 'jenis_maklumat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_program_bermula', 'tahun_siap_pembinaan', 'created', 'updated', 'tarikh_jkk_jkb', 'status_permohonan', 'status_permohonan_id', 'jenis_maklumat', 'kategori'], 'safe'],
            //[['kos_project'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created_by', 'updated_by', 'mesyuarat_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_pusat_latihan', 'hakmilik', 'jkk_jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_1', 'alamat_2', 'alamat_3', 'status', 'sukan', 'program'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_negeri'], 'string', 'max' => 3, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_bandar', 'alamat_poskod'], 'string', 'max' => 5, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['alamat_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_telefon', 'no_faks'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon', 'no_faks'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['keluasan_venue'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan', 'kos_project', 'kadar_sewaan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pusat_latihan', 'hakmilik', 'jkk_jkb','alamat_1', 'alamat_2', 'alamat_3', 'status', 'sukan', 'program','alamat_negeri','alamat_bandar','emel',
                'keluasan_venue','catatan', 'kos_project', 'kadar_sewaan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_pusat_latihan_id' => 'Profil Pusat Latihan ID',
            'sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'nama_pusat_latihan' => GeneralLabel::nama_pusat_latihan,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_telefon' => GeneralLabel::no_telefon,
            'no_faks' => GeneralLabel::no_faks,
            'emel' => GeneralLabel::emel,
            'tarikh_program_bermula' => GeneralLabel::tarikh_program_bermula,
            'tahun_siap_pembinaan' => GeneralLabel::tahun_siap_pembinaan,
            'kos_project' => GeneralLabel::kos_project,
            'keluasan_venue' => GeneralLabel::keluasan_venue,
            'hakmilik' => GeneralLabel::hakmilik,
            'kadar_sewaan' => GeneralLabel::kadar_sewa,
            'status' => GeneralLabel::status,
            'catatan' => GeneralLabel::catatan,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'jkk_jkb' => GeneralLabel::jkk_jkb,
            'tarikh_jkk_jkb' => GeneralLabel::tarikh_jkk_jkb,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'jenis_maklumat' => GeneralLabel::jenis_maklumat,
            'kategori' => GeneralLabel::kategori,
        ];
    }
    
    public function getRefNegeri()
    {
        return $this->hasOne(RefNegeri::className(), ['id' => 'alamat_negeri']);
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    public function getRefProgramSemasaSukanAtlet()
    {
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
    }
    
    public function getRefStatusPusatLatihan()
    {
        return $this->hasOne(RefStatusPusatLatihan::className(), ['id' => 'status']);
    }
    
    public function getRefJenisMaklumatPusatLatihan()
    {
        return $this->hasOne(RefJenisMaklumatPusatLatihan::className(), ['id' => 'jenis_maklumat']);
    }
}
