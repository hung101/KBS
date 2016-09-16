<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_program_binaan_jurulatih".
 *
 * @property integer $pengurusan_program_binaan_jurulatih_id
 * @property integer $pengurusan_program_binaan_id
 * @property integer $jurulatih_id
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanProgramBinaanJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_program_binaan_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_id'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_program_binaan_id', 'jurulatih_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_program_binaan_jurulatih_id' => 'Pengurusan Program Binaan Jurulatih ID',
            'pengurusan_program_binaan_id' => 'Pengurusan Program Binaan ID',
            'jurulatih_id' => GeneralLabel::jurulatih,
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
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih_id']);
    }
}
