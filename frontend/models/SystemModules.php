<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_system_modules".
 *
 * @property integer $system_modules_id
 * @property string $category
 * @property string $module_name
 * @property string $action
 * @property integer $sort
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class SystemModules extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_system_modules';
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
            [['category', 'module_name', 'action', 'sort'], 'required'],
            [['sort', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['category'], 'string', 'max' => 30],
            [['module_name', 'action'], 'string', 'max' => 255],
            [['category', 'action'], 'unique', 'targetAttribute' => ['category', 'action'], 'message' => 'The combination of Category and Action has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'system_modules_id' => 'System Modules ID',
            'category' => 'Category',
            'module_name' => 'Module Name',
            'action' => 'Action',
            'sort' => 'Sort',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
