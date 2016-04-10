<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_keluarga".
 *
 * @property integer $keluarga_id
 * @property integer $atlet_id
 * @property string $nama
 * @property string $hubungan
 * @property string $no_kad_pengenalan
 * @property string $tarikh_lahir
 * @property string $pekerjaan
 * @property string $bangsa
 * @property string $agama
 * @property string $no_tel
 */
class AtletKeluarga extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_keluarga';
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
            [['atlet_id', 'nama', 'hubungan', 'no_kad_pengenalan', 'tarikh_lahir', 'bangsa', 'agama'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tarikh_lahir'], 'safe'],
            [['nama', 'pekerjaan'], 'string', 'max' => 80],
            [['hubungan'], 'string', 'max' => 20],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['bangsa'], 'string', 'max' => 25],
            [['agama'], 'string', 'max' => 15],
            [['no_tel'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keluarga_id' => GeneralLabel::keluarga_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama' => GeneralLabel::nama,
            'hubungan' => GeneralLabel::hubungan,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'tarikh_lahir' => GeneralLabel::tarikh_lahir,
            'pekerjaan' => GeneralLabel::pekerjaan,
            'bangsa' => GeneralLabel::bangsa,
            'agama' => GeneralLabel::agama,
            'no_tel' => GeneralLabel::no_tel,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHubungan(){
        return $this->hasOne(RefHubungan::className(), ['id' => 'hubungan']);
    }
}
