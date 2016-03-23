<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_peralatan".
 *
 * @property integer $permohonan_peralatan_id
 * @property string $cawangan
 * @property string $negeri
 * @property string $sukan
 * @property string $program
 * @property string $tarikh
 * @property string $aktiviti
 * @property integer $jumlah_peralatan
 * @property string $nota_urus_setia
 * @property integer $kelulusan
 */
class PermohonanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_peralatan';
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
            [['cawangan', 'negeri', 'sukan', 'program', 'tarikh', 'aktiviti', 'jumlah_peralatan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['jumlah_peralatan', 'kelulusan'], 'integer'],
            [['cawangan', 'aktiviti'], 'string', 'max' => 80],
            [['negeri', 'sukan'], 'string', 'max' => 30],
            [['program'], 'string', 'max' => 90],
            [['nota_urus_setia'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_peralatan_id' => GeneralLabel::permohonan_peralatan_id,
            'cawangan' => GeneralLabel::cawangan,
            'negeri' => GeneralLabel::negeri,
            'sukan' => GeneralLabel::sukan,
            'program' => GeneralLabel::program,
            'tarikh' => GeneralLabel::tarikh,
            'aktiviti' => GeneralLabel::aktiviti,
            'jumlah_peralatan' => GeneralLabel::jumlah_peralatan,
            'nota_urus_setia' => GeneralLabel::nota_urus_setia,
            'kelulusan' => GeneralLabel::kelulusan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawangan(){
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgram(){
        return $this->hasOne(RefProgram::className(), ['id' => 'program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    public function getRefKelulusan()
    {
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}
