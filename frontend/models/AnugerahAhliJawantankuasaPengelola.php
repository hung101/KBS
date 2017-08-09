<?php

namespace app\models;

use Yii;


use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/**
 * This is the model class for table "tbl_anugerah_ahli_jawantankuasa_pengelola".
 *
 * @property integer $anugerah_ahli_jawantankuasa_pengelola_id
 * @property string $ajk
 * @property string $nama
 * @property string $bahagian
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahAhliJawantankuasaPengelola extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_ahli_jawantankuasa_pengelola';
    }
    
    public function behaviors()
    {
        return [
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
            [['tahun'], 'required'],
            [['created_by', 'updated_by', 'tahun'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['ajk', 'nama', 'bahagian'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['ajk', 'nama', 'bahagian'], 'filter', 'filter' => function ($value) {
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
            'anugerah_ahli_jawantankuasa_pengelola_id' => 'Anugerah Ahli Jawantankuasa Pengelola ID',
            'ajk' => GeneralLabel::ahli_jawatankuasa,  //'AJK',
            'nama' => GeneralLabel::nama,  //'Nama',
            'bahagian' => GeneralLabel::bahagian,  //'Bahagian',
            'tahun' => GeneralLabel::tahun,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAjk(){
        return $this->hasOne(RefAjk::className(), ['id' => 'ajk']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBahagianAjk(){
        return $this->hasOne(RefBahagianAjk::className(), ['id' => 'bahagian']);
    }
}
