<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_profil_wartawan_sukan".
 *
 * @property integer $profil_wartawan_sukan_id
 * @property string $nama
 * @property string $emel
 * @property string $agensi
 * @property string $no_tel
 * @property integer $aktif
 */
class ProfilWartawanSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_profil_wartawan_sukan';
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
            [['nama', 'agensi', 'no_tel', 'aktif'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['aktif'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nama', 'agensi'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['emel'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'profil_wartawan_sukan_id' => GeneralLabel::profil_wartawan_sukan_id,
            'nama' => GeneralLabel::nama,
            'emel' => GeneralLabel::emel,
            'agensi' => GeneralLabel::agensi,
            'no_tel' => GeneralLabel::no_tel,
            'aktif' => GeneralLabel::aktif,

        ];
    }
    
    public function getRefKelulusan()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'aktif']);
    }
}
