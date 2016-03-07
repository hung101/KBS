<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_ref_status_permohonan_e_bantuan".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefStatusPermohonanEBantuan extends \yii\db\ActiveRecord
{
    const STATUS_SEDANG_DI_SEMAK = 1;
    const STATUS_TAK_LENGKAP= 2;
    const STATUS_LULUS = 3;
    const STATUS_TOLAK = 4;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_status_permohonan_e_bantuan';
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
            [['desc'], 'string', 'max' => 80]
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
