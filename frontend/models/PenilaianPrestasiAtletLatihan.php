<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penilaian_prestasi_atlet_latihan".
 *
 * @property integer $tbl_penilaian_prestasi_atlet_latihan_id
 * @property integer $penilaian_pestasi_id
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempoh
 * @property string $tempat
 * @property string $keterangan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenilaianPrestasiAtletLatihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_prestasi_atlet_latihan';
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
            [['penilaian_pestasi_id', 'created_by', 'updated_by', 'penilaian_prestasi_atlet_sasaran_id', 'atlet_id'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'tempat', 'keterangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['keterangan'], 'string'],
            [['tempoh'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 90],
            [['session_id'], 'string', 'max' => 100],
            [['keterangan','tempoh','tempat'], 'filter', 'filter' => function ($value) {
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
            'tbl_penilaian_prestasi_atlet_latihan_id' => 'Tbl Penilaian Prestasi Atlet Latihan ID',
            'penilaian_pestasi_id' => 'Penilaian Pestasi ID',
            'atlet_id' => GeneralLabel::atlet,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'tempoh' => GeneralLabel::tempoh,
            'tempat' => GeneralLabel::tempat,
            'keterangan' => GeneralLabel::keterangan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
