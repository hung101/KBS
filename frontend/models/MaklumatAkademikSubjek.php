<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_maklumat_akademik_subjek".
 *
 * @property integer $maklumat_akademik_subjek_id
 * @property integer $maklumat_akademik_id
 * @property string $session_id
 * @property string $kod_subjek
 * @property string $subjek
 * @property integer $bil_kredit
 * @property string $nama_pensyarah
 * @property string $no_telefon
 * @property string $email
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class MaklumatAkademikSubjek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_akademik_subjek';
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
            [['kod_subjek', 'subjek'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['maklumat_akademik_id', 'bil_kredit', 'created_by', 'updated_by', 'no_telefon'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kod_subjek'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['subjek', 'nama_pensyarah', 'email'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['email'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['kod_subjek','subjek', 'nama_pensyarah', 'email'], 'filter', 'filter' => function ($value) {
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
            'maklumat_akademik_subjek_id' => 'Maklumat Akademik Subjek ID',
            'maklumat_akademik_id' => 'Maklumat Akademik ID',
            'session_id' => 'Session ID',
            'kod_subjek' => GeneralLabel::kod_subjek,
            'subjek' => GeneralLabel::subjek,
            'bil_kredit' => GeneralLabel::bil_kredit,
            'nama_pensyarah' => GeneralLabel::nama_pensyarah,
            'no_telefon' => GeneralLabel::tel_no,
            'email' => GeneralLabel::emel,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
