<?php

namespace bedezign\yii2\audit\models;
use bedezign\yii2\audit\components\db\ActiveRecord;
use Yii;

/**
 * AuditData
 * Extra data associated with a specific audit line. There are currently no guidelines concerning what the name/type
 * needs to be, this is at your own discretion.
 *
 * @property int    $id
 * @property int    $entry_id
 * @property string $type
 * @property string $data
 * @property string $created
 *
 * @property AuditEntry    $entry
 *
 * @package bedezign\yii2\audit\models
 */
class AuditMap extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%audit_map}}';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('audit', 'ID'),
            'path'  => Yii::t('audit', 'Entry Path'),
            'name'   => Yii::t('audit', 'Module Name'),
        ];
    }
}