<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_country".
 *
 * @property integer $id
 * @property string $desc
 * @property string $region
 * @property string $state
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefCountry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_country';
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
            [['desc', 'region', 'state'], 'string', 'max' => 80],
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
            'region' => 'Region',
            'state' => 'State',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
