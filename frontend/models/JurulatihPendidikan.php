<?php

namespace app\models;

use Yii;
use app\models\general\GeneralVariable;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_jurulatih_pendidikan".
 *
 * @property integer $jurulatih_pendidikan_id
 * @property integer $jurulatih_id
 * @property string $tahun
 * @property string $sekolah_kolej_universiti
 * @property string $gred
 */
class JurulatihPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_pendidikan';
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
            [['jurulatih_id', 'tahun', 'sekolah_kolej_universiti', 'gred'], 'required', 'skipOnEmpty' => true],
            [['jurulatih_id'], 'integer'],
            //[['tahun'], 'safe'],
            [['tahun'], 'integer','min'=>GeneralVariable::yearMin,'max'=>GeneralVariable::yearMax],
            [['sekolah_kolej_universiti'], 'string', 'max' => 80],
            [['gred'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_pendidikan_id' => GeneralLabel::jurulatih_pendidikan_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'tahun' => GeneralLabel::tahun,
            'sekolah_kolej_universiti' => GeneralLabel::sekolah_kolej_universiti,
            'gred' => GeneralLabel::gred,

        ];
    }
}
