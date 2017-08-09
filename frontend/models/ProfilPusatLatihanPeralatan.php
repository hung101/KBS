<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_profil_pusat_latihan_nama_peralatan".
 *
 * @property integer $profil_pusat_latihan_peralatan_id
 * @property integer $profil_pusat_latihan_id
 * @property string $nama_peralatan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ProfilPusatLatihanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_pusat_latihan_peralatan';
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
            [['nama_peralatan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['profil_pusat_latihan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nama_peralatan', 'status_peralatan', 'sukan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
            [['nama_peralatan', 'status_peralatan', 'sukan'], 'filter', 'filter' => function ($value) {
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
            'profil_pusat_latihan_peralatan_id' => 'Profil Pusat Latihan Jurulatih ID',
            'profil_pusat_latihan_id' => 'Profil Pusat Latihan ID',
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'status_peralatan' => GeneralLabel::status_peralatan,
            'sukan' => GeneralLabel::sukan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    public function getRefProfilPusatLatihan()
    {
        return $this->hasOne(ProfilPusatLatihan::className(), ['profil_pusat_latihan_id' => 'profil_pusat_latihan_id']);
    }
}
