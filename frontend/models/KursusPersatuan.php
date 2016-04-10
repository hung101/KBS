<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_kursus_persatuan".
 *
 * @property integer $kursus_persatuan_id
 * @property string $nama_kursus
 * @property string $tarikh
 * @property string $activiti
 * @property string $tempat
 * @property string $pegawai_terlibat
 */
class KursusPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kursus_persatuan';
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
            [['nama_kursus', 'tarikh', 'activiti', 'tempat', 'pegawai_terlibat'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['nama_kursus', 'activiti', 'pegawai_terlibat'], 'string', 'max' => 80],
            [['tempat'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kursus_persatuan_id' => GeneralLabel::kursus_persatuan_id,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'tarikh' => GeneralLabel::tarikh,
            'activiti' => GeneralLabel::activiti,
            'tempat' => GeneralLabel::tempat,
            'pegawai_terlibat' => GeneralLabel::pegawai_terlibat,

        ];
    }
}
