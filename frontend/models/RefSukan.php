<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_sukan".
 *
 * @property integer $ref_sukan_id
 * @property string $nama_sukan
 * @property integer $aktif
 */
class RefSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_sukan';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_kategori_sukan_id','desc', 'aktif'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['aktif'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['desc'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ref_sukan_id' => GeneralLabel::ref_sukan_id,
            'ref_kategori_sukan_id' => GeneralLabel::ref_kategori_sukan_id,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,

        ];
    }

    public function getRefKategoriSukan() {
        return $this->hasOne(RefKategoriSukan::className(), ['id' => 'ref_kategori_sukan_id']);
    }
}
