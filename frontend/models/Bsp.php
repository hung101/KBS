<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp".
 *
 * @property integer $bsp_pemohon_id
 * @property integer $atlet_id
 * @property string $peringkat_pengajian
 * @property string $bidang_pengajian
 * @property string $falkuti_pengajian
 * @property string $ipt
 * @property string $tahun_mula_pengajian
 * @property string $tahun_tamat_pengajian
 * @property string $tahun_ditawarkan_biasiswa
 * @property integer $kelulusan
 */
class Bsp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp';
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
            [['nama_penerima','no_kad_pengenalan','alamat_1','alamat_negeri','alamat_bandar','alamat_poskod','no_tel_bimbit','atlet_id', 'peringkat_pengajian', 'bidang_pengajian', 'falkuti_pengajian', 'ipt', 'tahun_mula_pengajian', 'tahun_tamat_pengajian', 'tahun_ditawarkan_biasiswa', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['tahun_mula_pengajian', 'tahun_tamat_pengajian', 'tahun_ditawarkan_biasiswa'], 'safe'],
            [['peringkat_pengajian'], 'string', 'max' => 30],
            [['bidang_pengajian', 'falkuti_pengajian', 'ipt'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'atlet_id' => 'Atlet ID',
            'nama_penerima' => 'Nama Penerima',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'alamat_1' => 'Alamat 1',
            'alamat_2' => 'Alamat 2',
            'alamat_3' => 'Alamat 3',
            'alamat_negeri' => 'Alamat Negeri',
            'alamat_bandar' => 'Alamat Bandar',
            'alamat_poskod' => 'Alamat Poskod',
            'no_tel_bimbit' => 'No Tel Bimbit',
            'peringkat_pengajian' => 'Peringkat Pengajian',
            'bidang_pengajian' => 'Bidang Pengajian',
            'falkuti_pengajian' => 'Falkuti Pengajian',
            'ipt' => 'IPT',
            'tahun_mula_pengajian' => 'Tahun Mula Pengajian',
            'tahun_tamat_pengajian' => 'Tahun Tamat Pengajian',
            'tahun_ditawarkan_biasiswa' => 'Tahun Ditawarkan Biasiswa',
            'kelulusan' => 'Kelulusan',
            'temuduga_tarikh' => 'Temuduga Tarikh',
        ];
    }
}
