<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_subjek_spm".
 *
 * @property integer $id
 * @property string $desc
 * @property string $kod
 * @property integer $aktif
 * @property integer $sort
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefSubjekSpm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_subjek_spm';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required'],
            [['aktif', 'sort', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80],
            [['kod'], 'string', 'max' => 20],
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
            'kod' => 'Kod',
            'aktif' => 'Aktif',
            'sort' => 'Sort',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
