<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_lawatan_rasmi_luar_negara_delegasi".
 *
 * @property integer $lawatan_rasmi_luar_negara_delegasi_id
 * @property integer $lawatan_rasmi_luar_negara_id
 * @property string $delegasi
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LawatanRasmiLuarNegaraDelegasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lawatan_rasmi_luar_negara_delegasi';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lawatan_rasmi_luar_negara_id', 'created_by', 'updated_by'], 'integer'],
            [['delegasi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['delegasi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lawatan_rasmi_luar_negara_delegasi_id' => 'Lawatan Rasmi Luar Negara Delegasi ID',
            'lawatan_rasmi_luar_negara_id' => 'Lawatan Rasmi Luar Negara ID',
            'delegasi' => GeneralLabel::delegasi,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
