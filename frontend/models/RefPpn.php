<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_ppn".
 *
 * @property integer $id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefPpn extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_ppn';
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
            [['desc', 'negeri', 'no_kad_pengenalan'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['aktif', 'created_by', 'updated_by', 'no_kad_pengenalan', 'tel_no_pejabat', 'tel_no_bimbit'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated', 'sukan'], 'safe'],
            [['desc', 'jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_kad_pengenalan'], 'string', 'max' => 12, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tel_no_pejabat', 'tel_no_bimbit'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['desc', 'jawatan','emel'], 'filter', 'filter' => function ($value) {
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
            'desc' => GeneralLabel::nama,
            'aktif' => GeneralLabel::aktif,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'negeri' => GeneralLabel::negeri,
            'jawatan' => GeneralLabel::jawatan,
            'sukan' => GeneralLabel::sukan,
            'tel_no_pejabat' => GeneralLabel::no_tel_pejabat,
            'tel_no_bimbit' => GeneralLabel::no_tel_bimbit,
            'emel' => GeneralLabel::emel,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,
        ];
    }
    
    public function getRefNegeri()
    {
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
    
    public function getRefSukan()
    {
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
