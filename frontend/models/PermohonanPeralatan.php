<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

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
            [['cawangan', 'negeri', 'sukan', 'program', 'tarikh', 'aktiviti', 'jumlah_peralatan', 'kelulusan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'tarikh_jkb'], 'safe'],
            [['jumlah_peralatan', 'kelulusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_diluluskan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['cawangan', 'aktiviti', 'bil_jkb'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negeri', 'sukan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['program'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nota_urus_setia', 'catatan_cadangan', 'catatan_kelulusan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
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
            'nota_urus_setia' => 'Catatan (Permohonan)',
            'kelulusan' => GeneralLabel::kelulusan,
            'bil_jkb' => 'Bil. JKB',
            'tarikh_jkb' => 'Tarikh JKB',
            'jumlah_diluluskan' => 'Jumlah Diluluskan (RM)',
            'catatan_cadangan' => 'Catatan (Cadangan)',
            'catatan_kelulusan' => 'Catatan (Kelulusan)',
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
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    public function getRefKelulusan()
    {
        return $this->hasOne(RefKelulusanPeralatan::className(), ['id' => 'kelulusan']);
    }
}
