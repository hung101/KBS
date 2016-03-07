<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_penyertaan_sukan".
 *
 * @property integer $penyertaan_sukan_id
 * @property string $nama_sukan
 * @property string $tempat_penginapan
 * @property string $tempat_latihan
 * @property string $nama_atlet
 * @property string $nama_pegawai
 * @property string $jawatan_pegawai
 * @property string $nama_pengurus_sukan
 * @property string $nama_sukarelawan
 */
class PenyertaanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan';
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
            [['kategori_penilaian', 'nama_temasya', 'nama_sukan', 'tempat_penginapan', 'tempat_latihan', 'nama_atlet', 'nama_pegawai', 'jawatan_pegawai', 'nama_pengurus_sukan', 'nama_sukarelawan'], 'required', 'skipOnEmpty' => true],
            [['nama_sukan', 'nama_atlet', 'nama_pegawai', 'jawatan_pegawai', 'nama_pengurus_sukan', 'nama_sukarelawan'], 'string', 'max' => 80],
            [['tempat_penginapan', 'tempat_latihan'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'kategori_penilaian' => 'Kategori Penilaian',
            'nama_temasya' => 'Nama Temasya',
            'nama_sukan' => 'Nama Sukan',
            'tempat_penginapan' => 'Tempat Penginapan',
            'tempat_latihan' => 'Tempat Latihan',
            'nama_atlet' => 'Nama Atlet',
            'nama_pegawai' => 'Nama Pegawai',
            'jawatan_pegawai' => 'Jawatan Pegawai',
            'nama_pengurus_sukan' => 'Nama Pengurus Sukan',
            'nama_sukarelawan' => 'Nama Sukarelawan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
}
