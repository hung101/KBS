<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pl_diagnosis_preskripsi_pemeriksaan".
 *
 * @property integer $pl_diagnosis_preskripsi_pemeriksaan_id
 * @property integer $pl_temujanji_id
 * @property string $jenis_diagnosis_preskripsi_pemeriksaan
 * @property string $status_diagnosis_preskripsi_pemeriksaan
 * @property string $catitan_ringkas
 */
class PlDiagnosisPreskripsiPemeriksaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pl_diagnosis_preskripsi_pemeriksaan';
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
            [['jenis_diagnosis_preskripsi_pemeriksaan', 'status_diagnosis_preskripsi_pemeriksaan', 'catitan_ringkas'], 'required', 'skipOnEmpty' => true],
            [['pl_temujanji_id', 'unit'], 'integer'],
            [['harga'], 'number'],
            [['tarikh'], 'safe'],
            [['jenis_diagnosis_preskripsi_pemeriksaan', 'status_diagnosis_preskripsi_pemeriksaan'], 'string', 'max' => 30],
            [['pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pl_diagnosis_preskripsi_pemeriksaan_id' => 'Pl Diagnosis Preskripsi Pemeriksaan ID',
            'pl_temujanji_id' => 'Temujanji ID',
            'tarikh' => 'Tarikh',
            'jenis_diagnosis_preskripsi_pemeriksaan' => 'Jenis Kecederaan / Masalah Kesihatan',
            'status_diagnosis_preskripsi_pemeriksaan' => 'Status Diagnosis / Preskripsi / Pemeriksaan / Penyiasatan',
            'pegawai_yang_bertanggungjawab' => 'Doktor / MA Bertanggungjawab',
            'unit' => 'Unit',
            'harga' => 'Caj & Fi',
            'catitan_ringkas' => 'Catitan Ringkas',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKecederaanMasalahKesihatan(){
        return $this->hasOne(RefJenisKecederaanMasalahKesihatan::className(), ['id' => 'jenis_diagnosis_preskripsi_pemeriksaan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan(){
        return $this->hasOne(RefStatusDiagnosisPreskripsiPemeriksaanPenyiasatan::className(), ['id' => 'status_diagnosis_preskripsi_pemeriksaan']);
    }
}
