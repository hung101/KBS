<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
/**
 * This is the model class for table "tbl_ref_cawangan_user".
 *
 * @property integer $id
 * @property integer $ref_jabatan_user_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $cacat
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefCawanganUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_cawangan_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_jabatan_user_id', 'ref_bahagian_user_id', 'aktif', 'cacat', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['desc'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => GeneralLabel::id,
            'ref_bahagian_user_id' => GeneralLabel::bahagian,
            'ref_jabatan_user_id' => GeneralLabel::jabatan,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,
        ];
    }
    
    public function getRefJabatanUser() {
        return $this->hasOne(RefJabatanUser::className(), ['id' => 'ref_jabatan_user_id']);
    }
    
    public function getRefBahagianUser() {
        return $this->hasOne(RefBahagianUser::className(), ['id' => 'ref_bahagian_user_id']);
    }
}
