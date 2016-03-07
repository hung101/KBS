<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_skim_kebajikan".
 *
 * @property integer $skim_kebajikan_id
 * @property string $jenis_bantuan_skak
 * @property string $jumlah_bantuan
 * @property string $nama_pemohon
 * @property string $nama_penerima
 * @property string $jenis_sukan
 * @property string $masalah_dihadapi
 * @property string $tarikh_kejadian
 * @property string $lokasi_kejadian
 * @property string $jenis_bantuan_lain_yang_diterima
 * @property integer $kelulusan
 */
class SkimKebajikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_skim_kebajikan';
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
            [['jenis_bantuan_skak', 'jumlah_bantuan', 'nama_pemohon', 'nama_penerima', 'jenis_sukan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['jumlah_bantuan'], 'number'],
            [['tarikh_kejadian'], 'safe'],
            [['kelulusan'], 'integer'],
            [['jenis_bantuan_skak', 'jenis_sukan', 'jenis_bantuan_lain_yang_diterima'], 'string', 'max' => 30],
            [['nama_pemohon', 'nama_penerima'], 'string', 'max' => 80],
            [['masalah_dihadapi'], 'string', 'max' => 100],
            [['lokasi_kejadian'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'skim_kebajikan_id' => 'Skim Kebajikan ID',
            'jenis_bantuan_skak' => 'Jenis Bantuan SKAK',
            'jumlah_bantuan' => 'Jumlah Bantuan',
            'nama_pemohon' => 'Nama Pemohon',
            'nama_penerima' => 'Nama Penerima',
            'jenis_sukan' => 'Jenis Sukan',
            'masalah_dihadapi' => 'Masalah Dihadapi',
            'tarikh_kejadian' => 'Tarikh Kejadian',
            'lokasi_kejadian' => 'Lokasi Kejadian',
            'jenis_bantuan_lain_yang_diterima' => 'Jenis Bantuan Lain Yang Diterima',
            'kelulusan' => 'Kelulusan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'nama_pemohon']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'jenis_sukan']);
    }
    
    public function getRefJenisBantuanSKAK()
    {
        return $this->hasOne(RefJenisBantuanSkak::className(), ['id' => 'jenis_bantuan_skak']);
    }
}
