<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_insentif_peringkat".
 *
 * @property integer $id
 * @property integer $ref_insentif_kejohanan_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefInsentifPeringkat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_insentif_peringkat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_insentif_kejohanan_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
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
            'ref_insentif_kejohanan_id' => 'Ref Insentif Kejohanan ID',
            'desc' => 'Desc',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
