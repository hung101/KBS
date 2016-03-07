<?php

namespace app\models;

use Yii;
use app\models\general\GeneralVariable;

/**
 * This is the model class for table "tbl_jurulatih_kursus_tertinggi".
 *
 * @property integer $kursus_tertinggi_id
 * @property integer $jurulatih_id
 * @property string $tahun
 * @property string $kursus
 */
class JurulatihKursusTertinggi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_kursus_tertinggi';
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
            [['jurulatih_id', 'tahun', 'kursus'], 'required', 'skipOnEmpty' => true],
            [['jurulatih_id'], 'integer'],
            //[['tahun'], 'safe'],
            [['tahun'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax],
            [['kursus'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_tertinggi_id' => 'Kursus Tertinggi ID',
            'jurulatih_id' => 'Jurulatih ID',
            'tahun' => 'Tahun',
            'kursus' => 'Kursus',
        ];
    }
}
