<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bsp_kedudukan_kewangan_penjamin".
 *
 * @property integer $bsp_kedudukan_kewangan_penjamin_id
 * @property integer $bsp_penjamin_id
 * @property string $pendapatan_bulanan
 * @property string $pinjaman_perumahan_baki_terkini
 * @property string $sebagai_penjamin_siberhutang
 * @property string $lain_lain_pinjaman_tanggungan
 * @property string $perkerjaan
 * @property string $nama_alamat_majikan
 * @property string $nama_isteri_suami
 * @property string $no_kp_isteri_suami
 * @property integer $jumlah_anak
 * @property string $pertalian_keluarga_dengan_pelajar
 * @property string $pelajar_lain_selain_daripada_penerima_di_atas
 */
class BspKedudukanKewanganPenjamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_kedudukan_kewangan_penjamin';
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
            [['pendapatan_bulanan', 'perkerjaan'], 'required', 'skipOnEmpty' => true],
            [['bsp_penjamin_id', 'jumlah_anak'], 'integer'],
            [['pendapatan_bulanan', 'pinjaman_perumahan_baki_terkini', 'sebagai_penjamin_siberhutang', 'lain_lain_pinjaman_tanggungan'], 'number'],
            [['perkerjaan', 'pertalian_keluarga_dengan_pelajar'], 'string', 'max' => 90],
            [['nama_alamat_majikan', 'pelajar_lain_selain_daripada_penerima_di_atas'], 'string', 'max' => 255],
            [['nama_isteri_suami'], 'string', 'max' => 80],
            [['no_kp_isteri_suami'], 'string', 'max' => 12]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_kedudukan_kewangan_penjamin_id' => 'Bsp Kedudukan Kewangan Penjamin ID',
            'bsp_penjamin_id' => 'Bsp Penjamin ID',
            'pendapatan_bulanan' => 'Pendapatan Bulanan (RM)',
            'pinjaman_perumahan_baki_terkini' => 'Pinjaman Perumahan (baki terkini) (RM)',
            'sebagai_penjamin_siberhutang' => 'Sebagai Penjamin Siberhutang (jumlah yang sedang dijamin) (RM)',
            'lain_lain_pinjaman_tanggungan' => 'Lain-lain Pinjaman/Tanggungan (RM)',
            'perkerjaan' => 'Perkerjaan',
            'nama_alamat_majikan' => 'Nama/Alamat Majikan',
            'nama_isteri_suami' => 'Nama Isteri/Suami',
            'no_kp_isteri_suami' => 'No K/P Isteri/Suami',
            'jumlah_anak' => 'Jumlah Anak',
            'pertalian_keluarga_dengan_pelajar' => 'Pertalian Keluarga Dengan Pelajar',
            'pelajar_lain_selain_daripada_penerima_di_atas' => 'Saya adalah penjamin kepada pelajar berikut (Sekiranya ada menjamin pelajar lain selain daripada penerima di atas)',
        ];
    }
}
