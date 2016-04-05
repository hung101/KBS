<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_psikologi_aktiviti".
 *
 * @property integer $psikologi_aktiviti_id
 * @property integer $psikologi_profil_id
 * @property string $nama_aktiviti
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 */
class PsikologiAktiviti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_psikologi_aktiviti';
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
            [['psikologi_profil_id', 'nama_aktiviti', 'tarikh_mula', 'tarikh_tamat'], 'required', 'skipOnEmpty' => true],
            [['psikologi_profil_id'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat'], 'safe'],
            [['nama_aktiviti'], 'string', 'max' => 80],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>='],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'psikologi_aktiviti_id' => GeneralLabel::psikologi_aktiviti_id,
            'psikologi_profil_id' => GeneralLabel::psikologi_profil_id,
            'nama_aktiviti' => GeneralLabel::nama_aktiviti,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,

        ];
    }
}
