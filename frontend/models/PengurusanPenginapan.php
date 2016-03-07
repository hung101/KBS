<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_penginapan".
 *
 * @property integer $pengurusan_penginapan_id
 * @property integer $atlet_id
 * @property string $nama_pegawai
 * @property string $tarikh_masa_penginapan_mula
 * @property string $tarikh_masa_penginapan_akhir
 * @property string $lokasi
 * @property string $nama_penginapan
 */
class PengurusanPenginapan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penginapan';
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
            [['atlet_id', 'nama_pegawai', 'tarikh_masa_penginapan_mula', 'tarikh_masa_penginapan_akhir', 'lokasi', 'nama_penginapan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_masa_penginapan_mula', 'tarikh_masa_penginapan_akhir'], 'safe'],
            [['nama_pegawai', 'nama_penginapan'], 'string', 'max' => 80],
            [['lokasi'], 'string', 'max' => 90],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penginapan_id' => 'Pengurusan Penginapan ID',
            'atlet_id' => 'Atlet',
            'nama_pegawai' => 'Nama Pegawai',
            'tarikh_masa_penginapan_mula' => 'Tarikh Masa Penginapan Mula',
            'tarikh_masa_penginapan_akhir' => 'Tarikh Masa Penginapan Akhir',
            'lokasi' => 'Lokasi',
            'nama_penginapan' => 'Nama Penginapan',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPegawaiPengurusanPenginapan(){
        return $this->hasOne(RefPegawaiPengurusanPenginapan::className(), ['id' => 'nama_pegawai']);
    }
}
