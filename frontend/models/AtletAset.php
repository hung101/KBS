<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_aset".
 *
 * @property integer $aset_id
 * @property integer $atlet_id
 * @property string $jenis_aset
 * @property string $daftar_no_pengangkutan
 * @property string $jenis_harta_pengangkutan_perniagaan
 * @property string $nilai_harta_pengangkutan
 * @property string $daftar_alamat
 * @property string $nama_syarikat_perniagaan
 * @property string $produk_perkhidmatan_perniagaan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AtletAset extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_aset';
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
            [['atlet_id', 'jenis_aset', 'jenis_harta_pengangkutan_perniagaan', 'nilai_harta_pengangkutan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'created_by', 'updated_by'], 'integer'],
            [['nilai_harta_pengangkutan'], 'number'],
            [['nama_bank','jenis_pinjaman','tarikh_mula','tarikh_tamat','no_akaun', 'nilai_pinjaman', 'daftar_alamat_negeri', 'daftar_alamat_bandar', 'daftar_alamat_poskod', 'created', 'updated'], 'safe'],
            [['jenis_aset', 'jenis_harta_pengangkutan_perniagaan'], 'string', 'max' => 30],
            [['daftar_no_pengangkutan'], 'string', 'max' => 10],
            [['daftar_alamat_1', 'daftar_alamat_2', 'daftar_alamat_3'], 'string', 'max' => 30],
            [['nama_syarikat_perniagaan', 'produk_perkhidmatan_perniagaan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'aset_id' => 'Aset ID',
            'atlet_id' => 'Atlet ID',
            'jenis_aset' => 'Jenis Aset',
            'daftar_no_pengangkutan' => 'No Daftar Pengangkutan',
            'jenis_harta_pengangkutan_perniagaan' => 'Jenis Harta/Pengangkutan/Perniagaan',
            'nilai_harta_pengangkutan' => 'Nilai Harta/Pengangkutan',
            'daftar_alamat_1' => 'Alamat Pendaftaran',
            'daftar_alamat_2' => '',
            'daftar_alamat_3' => '',
            'daftar_alamat_negeri' => 'Negeri',
            'daftar_alamat_bandar' => 'Bandar',
            'daftar_alamat_poskod' => 'Poskod',
            'nama_syarikat_perniagaan' => 'Nama Syarikat Perniagaan',
            'produk_perkhidmatan_perniagaan' => 'Produk/Perkhidmatan Perniagaan',
            'nama_bank' => 'Nama Bank',
            'jenis_pinjaman' => 'Jenis Pinjaman',
            'no_akaun' => 'No Akaun',
            'nilai_pinjaman' => 'Nilai Pinjaman',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisAset(){
        return $this->hasOne(RefJenisAset::className(), ['id' => 'jenis_aset']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisAsetSub(){
        return $this->hasOne(RefJenisAsetSub::className(), ['id' => 'jenis_harta_pengangkutan_perniagaan']);
    }
}
