<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kehadiran_media_program".
 *
 * @property integer $pengurusan_kehadiran_media_program_id
 * @property integer $pengurusan_media_program_id
 * @property string $program
 * @property string $nama_wartawan
 * @property string $emel
 * @property string $agensi
 * @property string $no_telefon
 */
class PengurusanKehadiranMediaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kehadiran_media_program';
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
            [['nama_wartawan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_media_program_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['program', 'nama_wartawan', 'agensi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_telefon'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama_wartawan'], 'unique', 'targetAttribute' => ['pengurusan_media_program_id', 'nama_wartawan'], 'when' => function ($model) {
                    return $model->pengurusan_media_program_id != "";
                }, 'message' => GeneralMessage::yii_validation_unique_multiple],
            [['nama_wartawan'], 'unique', 'targetAttribute' => ['session_id', 'nama_wartawan'], 'when' => function ($model) {
                    return $model->session_id != "";
                }, 'message' => GeneralMessage::yii_validation_unique_multiple],
            [['program', 'nama_wartawan', 'agensi','emel'], 'filter', 'filter' => function ($value) {
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
            'pengurusan_kehadiran_media_program_id' => GeneralLabel::pengurusan_kehadiran_media_program_id,
            'pengurusan_media_program_id' => GeneralLabel::pengurusan_media_program_id,
            'program' => GeneralLabel::program,
            'nama_wartawan' => GeneralLabel::nama_wartawan,
            'emel' => GeneralLabel::emel,
            'agensi' => GeneralLabel::agensi,
            'no_telefon' => GeneralLabel::no_telefon,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilWartawanSukan(){
        return $this->hasOne(ProfilWartawanSukan::className(), ['profil_wartawan_sukan_id' => 'nama_wartawan']);
    }
}
