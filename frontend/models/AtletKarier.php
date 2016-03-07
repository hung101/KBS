<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_karier".
 *
 * @property integer $karier_atlet_id
 * @property string $atlet_id
 * @property string $syarikat
 * @property string $alamat
 * @property string $laman_web
 * @property integer $tel_no
 * @property string $emel
 * @property string $jawatan_kerja
 * @property string $pendapatan
 * @property string $tahun_mula
 * @property string $tahun_tamat
 * @property string $socso_no
 * @property string $kwsp_no
 * @property string $income_tax_no
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AtletKarier extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_karier';
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
            [['atlet_id', 'syarikat', 'jawatan_kerja', 'pendapatan', 'tahun_mula', 'tahun_tamat', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tel_no'], 'required', 'skipOnEmpty' => true],
            [['tel_no', 'created_by', 'updated_by'], 'integer'],
            [['pendapatan'], 'number'],
            [['tahun_mula', 'tahun_tamat', 'created', 'updated'], 'safe'],
            [['atlet_id', 'socso_no', 'income_tax_no'], 'string', 'max' => 20],
            [['syarikat', 'emel'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['laman_web'], 'string', 'max' => 120],
            [['jawatan_kerja', 'alamat_negeri'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['kwsp_no'], 'string', 'max' => 10],
            [['alamat_poskod'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'karier_atlet_id' => 'Karier Atlet ID',
            'atlet_id' => 'Atlet ID',
            'syarikat' => 'Syarikat',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'laman_web' => 'Laman Web',
            'tel_no' => 'No Tel',
            'faks_no' => 'No Faks',
            'emel' => 'Emel',
            'jawatan_kerja' => 'Jawatan',
            'pendapatan' => 'Pendapatan',
            'tahun_mula' => 'Tahun Mula',
            'tahun_tamat' => 'Tahun Tamat',
            'socso_no' => 'No Perkeso',
            'kwsp_no' => 'No KWSP',
            'income_tax_no' => 'No Cukai Pendapatan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
