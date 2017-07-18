<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_borang_profil_peserta_kpsk".
 *
 * @property integer $borang_profil_peserta_kpsk_id
 * @property string $penganjur_kursus
 * @property string $kod_kursus
 * @property string $tarikh_kursus
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BorangProfilPesertaKpsk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_profil_peserta_kpsk';
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
            [['penganjur_kursus', 'tarikh_kursus', 'tarikh_tamat_kursus', 'tahap'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_kursus', 'tarikh_tamat_kursus', 'created', 'updated'], 'safe'],
            [['created_by', 'updated_by', 'tahap'], 'integer'],
            [['penganjur_kursus'], 'string', 'max' => 80],
            [['kod_kursus'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_profil_peserta_kpsk_id' => 'Borang Profil Peserta Kpsk ID',
            'penganjur_kursus' => GeneralLabel::agensi,  //'Penganjur Kursus',
            'kod_kursus' => GeneralLabel::kod_kursus,  //'Kod Kursus',
            'tarikh_tamat_kursus' => GeneralLabel::tarikh_tamat_kursus,
			'tarikh_kursus' => GeneralLabel::tarikh_mula_kursus,  //'Tarikh Kursus',
			'tahap' => GeneralLabel::tahap,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
