<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_informasi_persatuan".
 *
 * @property integer $informasi_persatuan_id
 * @property string $nama_persatuan
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $no_tel
 * @property string $no_faks
 * @property string $emel
 * @property string $laman_web
 */
class InformasiPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_informasi_persatuan';
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
            [['nama_persatuan', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel', 'no_faks'], 'required', 'skipOnEmpty' => true],
            [['nama_persatuan'], 'string', 'max' => 80],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5],
            [['no_tel', 'no_faks'], 'string', 'max' => 14],
            [['emel', 'laman_web'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'informasi_persatuan_id' => 'Informasi Persatuan ID',
            'nama_persatuan' => 'Nama Persatuan',
            'alamat_1' => 'Alamat 1',
            'alamat_2' => 'Alamat 2',
            'alamat_3' => 'Alamat 3',
            'alamat_negeri' => 'Alamat Negeri',
            'alamat_bandar' => 'Alamat Bandar',
            'alamat_poskod' => 'Alamat Poskod',
            'no_tel' => 'No Tel',
            'no_faks' => 'No Faks',
            'emel' => 'Emel',
            'laman_web' => 'Laman Web',
        ];
    }
}
