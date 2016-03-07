<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_permohonan_kursus_persatuan".
 *
 * @property integer $pengurusan_permohonan_kursus_persatuan_id
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
 * @property string $yuran_program
 * @property integer $kelulusan
 */
class PengurusanPermohonanKursusPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_permohonan_kursus_persatuan';
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
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'kelayakan_akademi', 'perkerjaan', 'nama_majikan', 'yuran_program', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_lahir'], 'safe'],
            [['yuran_program'], 'number'],
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
            'pengurusan_permohonan_kursus_persatuan_id' => 'Pengurusan Permohonan Kursus Persatuan ID',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'tarikh_lahir' => 'Tarikh Lahir',
            'jantina' => 'Jantina',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'emel' => 'Emel',
            'facebook' => 'Facebook',
            'kelayakan_akademi' => 'Kelayakan Akademi',
            'perkerjaan' => 'Perkerjaan',
            'nama_majikan' => 'Nama Majikan',
            'yuran_program' => 'Yuran Program',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJantina(){
        return $this->hasOne(RefJantina::className(), ['id' => 'jantina']);
    }
}
