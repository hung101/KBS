<?php

namespace app\models;

use Yii;

use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_kategori_hakmilik".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $tempahan_display_flag
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefKategoriHakmilik extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_kategori_hakmilik';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tempahan_display_flag', 'aktif', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
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
            'tempahan_display_flag' => 'Tempahan Display Flag',
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
