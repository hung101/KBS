<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_pusat_latihan_jurulatih".
 *
 * @property integer $profil_pusat_latihan_jurulatih_id
 * @property integer $profil_pusat_latihan_id
 * @property string $jurulatih
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilPusatLatihanJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_pusat_latihan_jurulatih';
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
            [['jurulatih'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_pusat_latihan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated', 'status'], 'safe'],
            [['jurulatih'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
            [['jurulatih'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_pusat_latihan_jurulatih_id' => 'Profil Pusat Latihan Jurulatih ID',
            'profil_pusat_latihan_id' => 'Profil Pusat Latihan ID',
            'jurulatih' => GeneralLabel::jurulatih,
            'status' => GeneralLabel::status,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getRefJurulatih()
    {
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
    
    public function getRefProfilPusatLatihan()
    {
        return $this->hasOne(ProfilPusatLatihan::className(), ['profil_pusat_latihan_id' => 'profil_pusat_latihan_id']);
    }
    
    public function getRefStatusJurulatih()
    {
        return $this->hasOne(RefStatusJurulatih::className(), ['id' => 'status']);
    }
}
