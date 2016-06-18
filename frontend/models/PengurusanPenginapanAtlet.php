<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_penginapan_atlet".
 *
 * @property integer $pengurusan_penginapan_atlet_id
 * @property integer $pengurusan_penginapan_id
 * @property integer $atlet_id
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanPenginapanAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penginapan_atlet';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penginapan_id', 'atlet_id', 'created_by', 'updated_by'], 'integer'],
            [['atlet_id'], 'required'],
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
            'pengurusan_penginapan_atlet_id' => 'Pengurusan Penginapan Atlet ID',
            'pengurusan_penginapan_id' => 'Pengurusan Penginapan ID',
            'atlet_id' => 'Atlet',
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
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
