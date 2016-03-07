<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_pendidikan".
 *
 * @property integer $pendidikan_atlet_id
 * @property string $atlet_id
 * @property string $jenis_peringkatan_pendidikan
 * @property string $kursus
 * @property string $fakulti
 * @property string $nama
 * @property string $alamat
 * @property integer $no_telefon
 * @property string $tahun_mula
 * @property string $tahun_tamat
 * @property string $pelajar_id_no
 * @property string $keputusan_cgpa
 * @property string $biasiswa_tajaan
 * @property string $jenis_biasiswa
 * @property string $jumlah_biasiswa
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AtletPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pendidikan';
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
            [['jenis_peringkatan_pendidikan', 'nama', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tahun_mula', 'tahun_tamat'], 'required', 'skipOnEmpty' => true],
            [['no_telefon', 'no_faks', 'created_by', 'updated_by'], 'integer'],
            [['tahun_mula', 'tahun_tamat', 'tahun_mula_biasiswa', 'tahun_tamat_biasiswa', 'created', 'updated'], 'safe'],
            [['jumlah_biasiswa'], 'number'],
            [['atlet_id', 'jenis_peringkatan_pendidikan'], 'string', 'max' => 20],
            [['kursus', 'fakulti', 'nama', 'alamat_bandar'], 'string', 'max' => 40],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['pelajar_id_no'], 'string', 'max' => 15],
            [['keputusan_cgpa'], 'string', 'max' => 100],
            [['biasiswa_tajaan'], 'string', 'max' => 2],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['jenis_biasiswa', 'alamat_negeri'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pendidikan_atlet_id' => 'Pendidikan Atlet ID',
            'atlet_id' => 'Atlet ID',
            'jenis_peringkatan_pendidikan' => 'Tahap Pendidikan',
            'kursus' => 'Kursus',
            'fakulti' => 'Fakulti',
            'nama' => 'Nama Institusi/Sekolah',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_telefon' => 'No Telefon',
            'no_faks' => 'No Faks',
            'tahun_mula' => 'Tahun Mula',
            'tahun_tamat' => 'Tahun Tamat',
            'pelajar_id_no' => 'Pelajar Id No',
            'keputusan_cgpa' => 'Keputusan/CGPA',
            'biasiswa_tajaan' => 'Biasiswa/Pinjaman',
            'jenis_biasiswa' => 'Biasiswa',
            'jumlah_biasiswa' => 'Jumlah',
            'tahun_mula_biasiswa' => 'Tahun Mula',
            'tahun_tamat_biasiswa' => 'Tahun Tamat',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTahapPendidikan(){
        return $this->hasOne(RefTahapPendidikan::className(), ['id' => 'jenis_peringkatan_pendidikan']);
    }
}
