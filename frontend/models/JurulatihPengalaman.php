<?php

namespace app\models;

use Yii;
use app\models\general\GeneralVariable;

/**
 * This is the model class for table "tbl_jurulatih_pengalaman".
 *
 * @property integer $jurulatih_pengalaman_id
 * @property integer $jurulatih_id
 * @property string $tahun
 * @property string $perkara_aktiviti
 */
class JurulatihPengalaman extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_pengalaman';
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
            [['jurulatih_id', 'tahun', 'perkara_aktiviti'], 'required', 'skipOnEmpty' => true],
            [['jurulatih_id'], 'integer'],
            [['tahun'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax],
            [['perkara_aktiviti'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_pengalaman_id' => 'Jurulatih Pengalaman ID',
            'jurulatih_id' => 'Jurulatih ID',
            'tahun' => 'Tahun',
            'perkara_aktiviti' => 'Perkara/Aktiviti',
        ];
    }
}
