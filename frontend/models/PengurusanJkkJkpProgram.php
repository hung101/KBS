<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_jkk_jkp_program".
 *
 * @property integer $pengurusan_jkk_jkp_program_id
 * @property integer $pengurusan_jkk_jkp_id
 * @property string $tarikh_mula_program
 * @property string $lokasi_program
 * @property string $nama_program
 * @property string $nama_pesserta
 */
class PengurusanJkkJkpProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jkk_jkp_program';
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
            [['pengurusan_jkk_jkp_id', 'tarikh_mula_program', 'tarikh_tamat_program', 'lokasi_program', 'nama_program', 'nama_pesserta'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_jkk_jkp_id'], 'integer'],
            [['tarikh_mula_program', 'tarikh_tamat_program'], 'safe'],
            [['lokasi_program'], 'string', 'max' => 30],
            [['nama_program', 'nama_pesserta'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jkk_jkp_program_id' => GeneralLabel::pengurusan_jkk_jkp_program_id,
            'pengurusan_jkk_jkp_id' => GeneralLabel::pengurusan_jkk_jkp_id,
            'tarikh_mula_program' => GeneralLabel::tarikh_mula_program,
            'tarikh_tamat_program' => GeneralLabel::tarikh_tamat_program,
            'lokasi_program' => GeneralLabel::lokasi_program,
            'nama_program' => GeneralLabel::nama_program,
            'nama_pesserta' => GeneralLabel::nama_pesserta,

        ];
    }
}
