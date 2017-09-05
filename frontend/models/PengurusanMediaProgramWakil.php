<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_media_program_wakil".
 *
 * @property integer $pengurusan_media_program_wakil_id
 * @property integer $pengurusan_media_program_id
 * @property string $nama_wakil
 * @property integer $kehadiran
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanMediaProgramWakil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_media_program_wakil';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_media_program_id', 'kehadiran', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nama_wakil'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
            [['nama_wakil'], function ($attribute, $params) {
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
            'pengurusan_media_program_wakil_id' => 'Pengurusan Media Program Wakil ID',
            'pengurusan_media_program_id' => 'Pengurusan Media Program ID',
            'nama_wakil' => GeneralLabel::nama_wakil,  //'Nama Wakil',
            'kehadiran' => GeneralLabel::kehadiran,  //'Kehadiran',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
     /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKehadiranMedia(){
        return $this->hasOne(RefKehadiranMedia::className(), ['id' => 'kehadiran']);
    }
}
