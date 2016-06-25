<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_status_program".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefStatusProgram extends \yii\db\ActiveRecord
{
    const LULUS = 1;
    const DALAM_PROSES = 2;
    const KIV = 3;
    const TIDAK_LULUS = 4;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_status_program';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
