<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_universiti_institusi_e_biasiswa".
 *
 * @property integer $id
 * @property integer $ref_universiti_institusi_kategori_e_biasiswa_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefUniversitiInstitusiEBiasiswa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_universiti_institusi_e_biasiswa';
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
            [['ref_universiti_institusi_kategori_e_biasiswa_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc'], 'required'],
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
            'id' => GeneralLabel::id,
            'ref_universiti_institusi_kategori_e_biasiswa_id' => GeneralLabel::ref_universiti_institusi_kategori_e_biasiswa_id,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }

    public function getRefUniversitiInstitusiKategoriEBiasiswa() {
        return $this->hasOne(RefUniversitiInstitusiKategoriEBiasiswa::className(), ['id' => 'ref_universiti_institusi_kategori_e_biasiswa_id']);
    }
}
