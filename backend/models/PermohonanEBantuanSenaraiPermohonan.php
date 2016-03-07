<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_senarai_permohonan".
 *
 * @property integer $senarai_permohonan_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $nama_program
 * @property string $tahun
 * @property string $jumlah_kelulusan
 * @property string $penghantaran_laporan
 */
class PermohonanEBantuanSenaraiPermohonan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_senarai_permohonan';
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
            [['nama_program', 'tahun', 'jumlah_kelulusan'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id', 'tahun'], 'integer'],
            [['jumlah_kelulusan'], 'number'],
            [['nama_program'], 'string', 'max' => 80],
            [['penghantaran_laporan'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_permohonan_id' => 'Senarai Permohonan ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'nama_program' => 'Nama Program',
            'tahun' => 'Tahun',
            'jumlah_kelulusan' => 'Jumlah Kelulusan',
            'penghantaran_laporan' => 'Penghantaran Laporan',
        ];
    }
}
