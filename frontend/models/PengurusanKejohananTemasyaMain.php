<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kejohanan_temasya_main".
 *
 * @property integer $pengurusan_kejohanan_temasya_main_id
 * @property integer $pengurusan_kejohanan_temasya_id
 * @property string $nama_temasya
 * @property string $nama_pertandingan
 * @property string $tarikh
 */
class PengurusanKejohananTemasyaMain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kejohanan_temasya_main';
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
            [['nama_temasya', 'nama_pertandingan', 'tarikh'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['nama_temasya', 'nama_pertandingan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kejohanan_temasya_main_id' => GeneralLabel::pengurusan_kejohanan_temasya_main_id,
            'nama_temasya' => GeneralLabel::nama_temasya,
            'nama_pertandingan' => GeneralLabel::nama_pertandingan,
            'tarikh' => GeneralLabel::tarikh,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTemasya(){
        return $this->hasOne(RefTemasya::className(), ['id' => 'nama_temasya']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPertandinganTemasya(){
        return $this->hasOne(RefPertandinganTemasya::className(), ['id' => 'nama_pertandingan']);
    }
}
