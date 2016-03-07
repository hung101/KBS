<?php

namespace app\models;

use Yii;

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
            [['nama_aktiviti'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'psikologi_aktiviti_id' => 'Psikologi Aktiviti ID',
            'psikologi_profil_id' => 'Pegawai Psikologi',
            'nama_aktiviti' => 'Nama Aktiviti',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
        ];
    }
}
