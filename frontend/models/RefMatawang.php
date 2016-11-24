<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_matawang".
 *
 * @property integer $id
 * @property string $desc
 * @property string $kod_1
 * @property string $kod_2
 * @property string $kod_3
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefMatawang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_matawang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 150],
            [['kod_1', 'kod_2', 'kod_3'], 'string', 'max' => 5],
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
            'kod_1' => 'Kod 1',
            'kod_2' => 'Kod 2',
            'kod_3' => 'Kod 3',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
