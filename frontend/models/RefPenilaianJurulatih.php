<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_penilaian_jurulatih".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_penilaian_jurulatih';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc', 'markah_peratus'], 'required'],
            [['aktif', 'created_by', 'updated_by'], 'integer'],
            [['markah_peratus'], 'number'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80],
            [['markah_peratus'], 'string', 'max' => 10],
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
            'markah_peratus' => 'Markah Peratus',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
