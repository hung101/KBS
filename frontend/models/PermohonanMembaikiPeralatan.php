<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_membaiki_peralatan".
 *
 * @property integer $permohonan_membaiki_peralatan_id
 * @property string $tarikh_permohonan
 * @property string $pemohon
 * @property string $nama_peralatan
 * @property string $model
 * @property string $nombor_siri
 * @property string $tarikh_diterima
 * @property string $tarikh_dipulang
 * @property string $kerosakan
 * @property string $simptom_kerosakan
 * @property string $komponen_utama
 * @property string $proses_pemeriksaan
 * @property string $pembaikan
 * @property string $cadangan
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 * @property string $status_permohonan
 */
class PermohonanMembaikiPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_membaiki_peralatan';
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
            [['tarikh_permohonan', 'pemohon', 'nama_peralatan', 'pegawai_yang_bertanggungjawab', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_permohonan', 'tarikh_diterima', 'tarikh_dipulang'], 'safe'],
            [['pemohon', 'nama_peralatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['model', 'nombor_siri'], 'string', 'max' => 40],
            [['kerosakan', 'simptom_kerosakan', 'komponen_utama', 'proses_pemeriksaan', 'pembaikan', 'cadangan', 'catitan_ringkas'], 'string', 'max' => 255],
            [['status_permohonan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_membaiki_peralatan_id' => 'Permohonan Membaiki Peralatan ID',
            'tarikh_permohonan' => 'Tarikh Permohonan',
            'pemohon' => 'Pemohon',
            'nama_peralatan' => 'Nama Peralatan',
            'model' => 'Model',
            'nombor_siri' => 'Nombor Siri',
            'tarikh_diterima' => 'Tarikh Diterima',
            'tarikh_dipulang' => 'Tarikh Dipulang',
            'kerosakan' => 'Kerosakan',
            'simptom_kerosakan' => 'Simptom Kerosakan',
            'komponen_utama' => 'Komponen Utama',
            'proses_pemeriksaan' => 'Proses Pemeriksaan',
            'pembaikan' => 'Pembaikan',
            'cadangan' => 'Cadangan',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'catitan_ringkas' => 'Catitan Ringkas',
            'status_permohonan' => 'Status Permohonan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeralatanPermohonanMembaiki(){
        return $this->hasOne(RefPeralatanPermohonanMembaiki::className(), ['id' => 'nama_peralatan']);
    }
}
