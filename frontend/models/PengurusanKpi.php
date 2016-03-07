<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_kpi".
 *
 * @property integer $pengurusan_kpi_id
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property integer $jumlah_sasaran_pingat
 * @property integer $jumlah_pingat_yang_telah_dimenangi
 * @property string $rekod_baru_yang_dicipta
 * @property string $senarai_atlet_yang_memenangi
 */
class PengurusanKpi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kpi';
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
            [['nama_sukan', 'nama_acara', 'jumlah_sasaran_pingat', 'jumlah_pingat_yang_telah_dimenangi', 'rekod_baru_yang_dicipta', 'senarai_atlet_yang_memenangi'], 'required', 'skipOnEmpty' => true],
            [['jumlah_sasaran_pingat', 'jumlah_pingat_yang_telah_dimenangi'], 'integer'],
            [['senarai_atlet_yang_memenangi'], 'safe'],
            [['nama_sukan', 'nama_acara', 'rekod_baru_yang_dicipta'], 'string', 'max' => 80],
            //[['senarai_atlet_yang_memenangi'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kpi_id' => 'Pengurusan Kpi ID',
            'nama_sukan' => 'Nama Sukan',
            'nama_acara' => 'Nama Acara',
            'jumlah_sasaran_pingat' => 'Jumlah Sasaran Pingat',
            'jumlah_pingat_yang_telah_dimenangi' => 'Jumlah Pingat Yang Telah Dimenangi',
            'rekod_baru_yang_dicipta' => 'Rekod Baru Yang Dicipta',
            'senarai_atlet_yang_memenangi' => 'Senarai Atlet Yang Memenangi',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
