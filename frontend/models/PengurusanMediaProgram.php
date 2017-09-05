<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_media_program".
 *
 * @property integer $pengurusan_media_program_id
 * @property string $tarikh_mula
 * @property string $nama_program
 * @property string $tempat
 * @property string $cawangan
 * @property string $maklumat_msn_negeri
 * @property string $catatan
 */
class PengurusanMediaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_media_program';
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
            [['tarikh_mula', 'tarikh_tamat', 'nama_program', 'tempat', 'cawangan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula'], 'safe'],
            [['nama_program', 'cawangan', 'maklumat_msn_negeri', 'pengerusi_program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_program', 'cawangan', 'maklumat_msn_negeri', 'pengerusi_program','tempat','catatan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_media_program_id' => GeneralLabel::pengurusan_media_program_id,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'nama_program' => GeneralLabel::nama_program,
            'tempat' => GeneralLabel::tempat,
            'cawangan' => GeneralLabel::cawangan,  //'Bahagian / Cawangan',
            'maklumat_msn_negeri' => GeneralLabel::maklumat_msn_negeri,
            'catatan' => GeneralLabel::catatan,
            'pengerusi_program' => GeneralLabel::pengerusi_program,

        ];
    }
}
