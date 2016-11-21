<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_khidmat_perubatan_dan_sains_sukan_atlet".
 *
 * @property integer $khidmat_perubatan_dan_sains_sukan_atlet_id
 * @property integer $khidmat_perubatan_dan_sains_sukan_id
 * @property integer $program
 * @property integer $sukan
 * @property integer $atlet
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class KhidmatPerubatanDanSainsSukanAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_khidmat_perubatan_dan_sains_sukan_atlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['khidmat_perubatan_dan_sains_sukan_id', 'program', 'sukan', 'atlet', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['program', 'sukan', 'atlet'], 'required', 'message' => GeneralMessage::yii_validation_required],
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
            'khidmat_perubatan_dan_sains_sukan_atlet_id' => 'Khidmat Perubatan Dan Sains Sukan Atlet ID',
            'khidmat_perubatan_dan_sains_sukan_id' => 'Khidmat Perubatan Dan Sains Sukan ID',
            'program' => 'Program',
            'sukan' => 'Sukan',
            'atlet' => 'Atlet',
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
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
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
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
}
