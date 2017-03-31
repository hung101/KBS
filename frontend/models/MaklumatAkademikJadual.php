<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_maklumat_akademik_jadual".
 *
 * @property integer $maklumat_akademik_jadual_id
 * @property integer $maklumat_akademik_id
 * @property string $session_id
 * @property string $tarikh
 * @property string $masa_dari
 * @property string $masa_hingga
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class MaklumatAkademikJadual extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_akademik_jadual';
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
			[['masa_dari', 'masa_hingga', 'hari'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['maklumat_akademik_id', 'created_by', 'updated_by', 'hari'], 'integer'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['masa_dari', 'masa_hingga'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
			[['perkara'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'maklumat_akademik_jadual_id' => 'Maklumat Akademik Jadual ID',
            'maklumat_akademik_id' => 'Maklumat Akademik ID',
            'session_id' => 'Session ID',
            'tarikh' => GeneralLabel::tarikh,
            'masa_dari' => GeneralLabel::dari,
            'masa_hingga' => GeneralLabel::hingga,
			'perkara' => GeneralLabel::perkara,
			'hari' => GeneralLabel::hari,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefHari(){
        return $this->hasOne(RefHari::className(), ['id' => 'hari']);
    }
}
