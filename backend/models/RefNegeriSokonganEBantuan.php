<?php

namespace app\models;

use Yii;

use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_negeri_sokongan_e_bantuan".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefNegeriSokonganEBantuan extends \yii\db\ActiveRecord
{
    const STATUS_LULUS = 1;
    const STATUS_TOLAK = 2;
    const STATUS_HANTAR_KE_HQ = 3;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_negeri_sokongan_e_bantuan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['desc'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['aktif', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
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
            'aktif' => 'Aktif',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
