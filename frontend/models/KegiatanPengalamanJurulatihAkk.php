<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kegiatan_pengalaman_jurulatih_akk".
 *
 * @property integer $kegiatan_pengalaman_jurulatih_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_sukan_pertandingan
 * @property string $tahun
 * @property string $peranan
 * @property string $persatuan_sukan
 */
class KegiatanPengalamanJurulatihAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kegiatan_pengalaman_jurulatih_akk';
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
            [['nama_sukan_pertandingan', 'tahun', 'peranan', 'peringkat', 'persatuan_sukan'], 'required', 'skipOnEmpty' => true],
            [['akademi_akk_id'], 'integer'],
            [['tahun'], 'safe'],
            [['nama_sukan_pertandingan', 'peranan', 'persatuan_sukan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kegiatan_pengalaman_jurulatih_akk_id' => 'Kegiatan Pengalaman Jurulatih Akk ID',
            'akademi_akk_id' => 'Akademi Akk ID',
            'nama_sukan_pertandingan' => 'Nama Sukan/Pertandingan',
            'tahun' => 'Tahun',
            'peranan' => 'Peranan',
            'peringkat' => 'Peringkat',
            'persatuan_sukan' => 'Persatuan Sukan',
            'dokumen_lampiran' => 'Dokumen Lampiran'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeringkatPengalamanJurulatih(){
        return $this->hasOne(RefPeringkatPengalamanJurulatih::className(), ['id' => 'peringkat']);
    }
}
