<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_status_permohonan_pendidikan".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefStatusPermohonanPendidikan extends \yii\db\ActiveRecord
{
    const GAGAL = 1;
    const LULUS = 2;
    const DALAM_PROSES = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_status_permohonan_pendidikan';
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
