<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat".
 *
 * @property integer $pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $jawatan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel_bimbit
 * @property string $emel
 * @property string $muatnaik_dokumen
 * @property string $nama_kejohonan
 * @property string $muatnaik_dokumen_kejohanan
 * @property string $status_permohonan
 */
class PengurusanPerhubunganDalamDanLuarNegaraMesyuarat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat';
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
            [['nama', 'no_kad_pengenalan', 'jawatan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'nama_kejohonan', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['nama', 'jawatan', 'nama_kejohonan'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'status_permohonan'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel_bimbit'], 'string', 'max' => 14],
            [['emel', 'muatnaik_dokumen', 'muatnaik_dokumen_kejohanan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhubungan_dalam_dan_luar_negara_mesyuarat_id' => 'Pengurusan Perhubungan Dalam Dan Luar Negara Mesyuarat ID',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'jawatan' => 'Jawatan',
            'alamat_1' => 'Alamat 1',
            'alamat_2' => 'Alamat 2',
            'alamat_3' => 'Alamat 3',
            'alamat_negeri' => 'Alamat Negeri',
            'alamat_bandar' => 'Alamat Bandar',
            'alamat_poskod' => 'Alamat Poskod',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'emel' => 'Emel',
            'muatnaik_dokumen' => 'Muatnaik Dokumen',
            'nama_kejohonan' => 'Nama Kejohonan',
            'muatnaik_dokumen_kejohanan' => 'Muatnaik Dokumen Kejohanan',
            'status_permohonan' => 'Status Permohonan',
        ];
    }
}
