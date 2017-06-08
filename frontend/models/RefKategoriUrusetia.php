<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_kategori_urusetia".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefKategoriUrusetia extends \yii\db\ActiveRecord
{
    const JBS_NEGERI = 1;
    const INDUK_JBS_NEGERI = 2;
    const BAHAGIAN_JBSN = 3;
    const INDUK_JBSN = 4;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_kategori_urusetia';
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
