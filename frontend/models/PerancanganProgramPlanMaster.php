<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_perancangan_program_plan_master".
 *
 * @property integer $tbl_perancangan_program_plan_master_id
 * @property integer $cawangan
 * @property integer $sukan
 * @property integer $program
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $sasaran
 * @property string $kejohanan
 * @property string $target
 * @property string $remarks
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PerancanganProgramPlanMaster extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_perancangan_program_plan_master';
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
            [['cawangan', 'sukan', 'program', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['remarks'], 'string'],
            [['sasaran', 'kejohanan', 'target'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'perancangan_program_plan_master_id' => 'Perancangan Program Plan Master ID',
            'cawangan' => GeneralLabel::cawangan,
            'sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'sasaran' => GeneralLabel::sasaran. ' (Medal)',
            'kejohanan' => GeneralLabel::kejohanan,
            'target' => 'Target',
            'remarks' => 'Remarks / Others',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawangan(){
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
}
