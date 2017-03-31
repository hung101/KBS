<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_mesyuarat_senarai_nama_hadir".
 *
 * @property integer $senarai_nama_hadir_id
 * @property integer $mesyuarat_id
 * @property string $nama
 * @property integer $kehadiran
 */
class MesyuaratJkkKehadiran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mesyuarat_jkk_kehadiran';
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
            [['nama', 'status', 'no_tel', 'jawatan', 'organisasi', 'kehadiran', 'agensi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['mesyuarat_id', 'kehadiran'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
            [['nama'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['no_tel'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['no_tel'], 'string', 'max' => 14, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_nama_hadir_id' => GeneralLabel::senarai_nama_hadir_id,
            'mesyuarat_id' => GeneralLabel::mesyuarat_id,
            'nama' => GeneralLabel::nama,
            'status' => GeneralLabel::status,
            'jawatan' => GeneralLabel::jawatan,
            'organisasi' => GeneralLabel::organisasi,
            'no_tel' => GeneralLabel::no_tel,
            'emel' => GeneralLabel::emel,
            'kehadiran' => GeneralLabel::kehadiran,
            'agensi' => GeneralLabel::agensi,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kehadiran']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgensiJkk(){
        return $this->hasOne(RefAgensiJkk::className(), ['id' => 'agensi']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanJkkJkp(){
        return $this->hasOne(RefJawatanJkkJkp::className(), ['id' => 'jawatan']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getPengurusanJkkJkp(){
        return $this->hasOne(PengurusanJkkJkp::className(), ['pengurusan_jkk_jkp_id' => 'nama']);
    }
}
