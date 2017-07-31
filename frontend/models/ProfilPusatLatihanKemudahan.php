<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_pusat_latihan_sukan".
 *
 * @property integer $profil_pusat_latihan_kemudahan_id
 * @property integer $profil_pusat_latihan_id
 * @property string $sukan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilPusatLatihanKemudahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_pusat_latihan_kemudahan';
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
            [['sukan', 'jenis_kemudahan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_pusat_latihan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['sukan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_pusat_latihan_kemudahan_id' => 'Profil Pusat Latihan Jurulatih ID',
            'profil_pusat_latihan_id' => 'Profil Pusat Latihan ID',
            'jenis_kemudahan' => GeneralLabel::jenis_kemudahan,
            'sukan' => GeneralLabel::sukan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getRefProfilPusatLatihan()
    {
        return $this->hasOne(ProfilPusatLatihan::className(), ['profil_pusat_latihan_id' => 'profil_pusat_latihan_id']);
    }
    
    public function getRefJenisKemudahan()
    {
        return $this->hasOne(RefJenisKemudahan::className(), ['id' => 'jenis_kemudahan']);
    }
}
