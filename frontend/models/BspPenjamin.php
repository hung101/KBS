<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_penjamin".
 *
 * @property integer $bsp_penjamin_id
 * @property integer $bsp_pemohon_id
 * @property string $nama
 * @property string $no_kad_pengenalan
 * @property string $alamat_tetap_1
 * @property string $alamat_tetap_2
 * @property string $alamat_tetap_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $alamat_surat_menyurat_1
 * @property string $alamat_surat_menyurat_2
 * @property string $alamat_surat_menyurat_3
 * @property string $alamat_surat_menyurat_negeri
 * @property string $alamat_surat_menyurat_bandar
 * @property string $alamat_surat_menyurat_poskod
 * @property string $no_telefon_rumah
 * @property string $no_telefon_pejabat
 * @property string $no_telefon_bimbit
 * @property string $email
 * @property string $alamat_pejabat_1
 * @property string $alamat_pejabat_2
 * @property string $alamat_pejabat_3
 * @property string $alamat_pejabat_negeri
 * @property string $alamat_pejabat_bandar
 * @property string $alamat_pejabat_poskod
 */
class BspPenjamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_penjamin';
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
            [['nama', 'no_kad_pengenalan', 'alamat_tetap_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 'alamat_surat_menyurat_poskod', 'no_telefon_bimbit'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['nama'], 'string', 'max' => 80],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['alamat_tetap_1', 'alamat_tetap_2', 'alamat_tetap_3', 'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_pejabat_1', 'alamat_pejabat_2', 'alamat_pejabat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'alamat_surat_menyurat_negeri', 'alamat_pejabat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar', 'alamat_surat_menyurat_bandar', 'alamat_pejabat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod', 'alamat_surat_menyurat_poskod', 'alamat_pejabat_poskod'], 'string', 'max' => 5],
            [['no_telefon_rumah', 'no_telefon_pejabat', 'no_telefon_bimbit'], 'string', 'max' => 14],
            [['email'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_penjamin_id' => 'Bsp Penjamin ID',
            'bsp_pemohon_id' => 'Bsp Pemohon ID',
            'nama' => 'Nama',
            'no_kad_pengenalan' => 'No Kad Pengenalan',
            'alamat_tetap_1' => 'Alamat Tetap',
            'alamat_tetap_2' => '',
            'alamat_tetap_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'alamat_surat_menyurat_1' => 'Alamat Surat Menyurat',
            'alamat_surat_menyurat_2' => '',
            'alamat_surat_menyurat_3' => '',
            'alamat_surat_menyurat_negeri' => 'Negeri',
            'alamat_surat_menyurat_bandar' => 'Bandar',
            'alamat_surat_menyurat_poskod' => 'Poskod',
            'no_telefon_rumah' => 'No Telefon Rumah',
            'no_telefon_pejabat' => 'No Telefon Pejabat',
            'no_telefon_bimbit' => 'No Telefon Bimbit',
            'email' => 'Email',
            'alamat_pejabat_1' => 'Alamat Pejabat',
            'alamat_pejabat_2' => '',
            'alamat_pejabat_3' => '',
            'alamat_pejabat_negeri' => 'Negeri',
            'alamat_pejabat_bandar' => 'Bandar',
            'alamat_pejabat_poskod' => 'Poskod',
        ];
    }
}
