<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_permohonan_pendidikan".
 *
 * @property integer $pengurusan_permohonan_pendidikan_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $jantina
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $emel
 * @property string $facebook
 * @property string $kelayakan_akademi
 * @property string $perkerjaan
 * @property string $nama_majikan
 * @property integer $kelulusan
 */
class PengurusanPermohonanPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_permohonan_pendidikan';
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
            [['jenis_penganjuran', 'cadangan_program_kursus_bengkel', 'nama_program_kursus_bengkel', 'tarikh', 'nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'kelayakan_akademi', 'perkerjaan', 'nama_majikan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['kelulusan'], 'integer'],
            [['nama', 'kelayakan_akademi', 'perkerjaan', 'nama_majikan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['emel', 'facebook'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_permohonan_pendidikan_id' => GeneralLabel::pengurusan_permohonan_pendidikan_id,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'jawatan' => GeneralLabel::jawatan,
            'persatuan' => GeneralLabel::persatuan,
            'jenis_penganjuran' => GeneralLabel::jenis_penganjuran,
            'cadangan_program_kursus_bengkel' => GeneralLabel::cadangan_program_kursus_bengkel,
            'nama_program_kursus_bengkel' => GeneralLabel::nama_program_kursus_bengkel,
            'tarikh' => GeneralLabel::tarikh,
            'nama' => GeneralLabel::nama,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'jantina' => GeneralLabel::jantina,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'no_tel_bimbit' => GeneralLabel::no_tel_bimbit,
            'emel' => GeneralLabel::emel,
            'facebook' => GeneralLabel::facebook,
            'kelayakan_akademi' => GeneralLabel::kelayakan_akademi,
            'perkerjaan' => GeneralLabel::perkerjaan,
            'nama_majikan' => GeneralLabel::nama_majikan,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
