<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_jkk_jkp_bajet".
 *
 * @property integer $pengurusan_jkk_jkp_bajet_id
 * @property integer $pengurusan_jkk_jkp_id
 * @property string $kategori_bajet
 * @property string $jumlah_bajet
 */
class PengurusanJkkJkpBajet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jkk_jkp_bajet';
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
            [['pengurusan_jkk_jkp_id', 'kategori_bajet', 'jumlah_bajet'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_jkk_jkp_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_bajet'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori_bajet'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jkk_jkp_bajet_id' => GeneralLabel::pengurusan_jkk_jkp_bajet_id,
            'pengurusan_jkk_jkp_id' => GeneralLabel::pengurusan_jkk_jkp_id,
            'kategori_bajet' => GeneralLabel::kategori_bajet,
            'jumlah_bajet' => GeneralLabel::jumlah_bajet,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriBajetJkkJkp(){
        return $this->hasOne(RefKategoriBajetJkkJkp::className(), ['id' => 'kategori_bajet']);
    }
}
