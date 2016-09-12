<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_acara_insentif".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefAcaraInsentif extends \yii\db\ActiveRecord
{
    const INDIVIDU = 1;
    const BERPASUKAN = 2;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_acara_insentif';
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
