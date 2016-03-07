<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kegiatan_pengalaman_atlet_akk".
 *
 * @property integer $kegiatan_pengalaman_atlet_akk_id
 * @property integer $akademi_akk_id
 * @property string $nama_sukan_pertandingan
 * @property string $tahun
 * @property string $sukan_acara
 * @property string $pencapaian
 */
class KegiatanPengalamanAtletAkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kegiatan_pengalaman_atlet_akk';
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
            [['nama_sukan_pertandingan', 'tahun', 'sukan_acara', 'pencapaian'], 'required', 'skipOnEmpty' => true],
            [['akademi_akk_id'], 'integer'],
            [['tahun'], 'safe'],
            [['nama_sukan_pertandingan', 'sukan_acara', 'pencapaian'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kegiatan_pengalaman_atlet_akk_id' => 'Kegiatan Pengalaman Atlet Akk ID',
            'akademi_akk_id' => 'Akademi Akk ID',
            'nama_sukan_pertandingan' => 'Nama Sukan/Pertandingan',
            'tahun' => 'Tahun',
            'sukan_acara' => 'Sukan Acara',
            'pencapaian' => 'Pencapaian',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'sukan_acara']);
    }
}
