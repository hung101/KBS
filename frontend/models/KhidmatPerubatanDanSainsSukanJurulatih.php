<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_khidmat_perubatan_dan_sains_sukan_jurulatih".
 *
 * @property integer $khidmat_perubatan_dan_sains_sukan_jurulatih_id
 * @property integer $khidmat_perubatan_dan_sains_sukan_id
 * @property integer $program
 * @property integer $sukan
 * @property integer $jurulatih
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class KhidmatPerubatanDanSainsSukanJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_khidmat_perubatan_dan_sains_sukan_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_id', 'program', 'sukan', 'jurulatih', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['program', 'sukan', 'jurulatih'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'khidmat_perubatan_dan_sains_sukan_jurulatih_id' => 'Khidmat Perubatan Dan Sains Sukan Jurulatih ID',
            'khidmat_perubatan_dan_sains_sukan_id' => 'Khidmat Perubatan Dan Sains Sukan ID',
            'program' => 'Program',
            'sukan' => 'Sukan',
            'jurulatih' => 'Jurulatih',
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
    public function getRefProgramJurulatih(){
        return $this->hasOne(RefProgramJurulatih::className(), ['id' => 'program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
    }
}
