<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;


/**
 * This is the model class for table "tbl_anugerah_ahli_jawantankuasa_pemilihan_item".
 *
 * @property integer $anugerah_ahli_jawantankuasa_pemilihan_item_id
 * @property string $anugerah_ahli_jawantankuasa_pemilihan_id
 * @property string $perwakilan
 * @property string $nama
 * @property string $jawatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahAhliJawantankuasaPemilihanItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_ahli_jawantankuasa_pemilihan_item';
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
            [['perwakilan', 'nama', 'jawatan'], 'required'],
            [['anugerah_ahli_jawantankuasa_pemilihan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['perwakilan', 'nama', 'jawatan', 'session_id'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['perwakilan', 'nama', 'jawatan'], 'filter', 'filter' => function ($value) {
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
            'anugerah_ahli_jawantankuasa_pemilihan_item_id' => 'Anugerah Ahli Jawantankuasa Pemilihan Item ID',
            'anugerah_ahli_jawantankuasa_pemilihan_id' => 'Anugerah Ahli Jawantankuasa Pemilihan ID',
            'perwakilan' => GeneralLabel::perwakilan,  //'Perwakilan',
            'nama' => GeneralLabel::nama,  //'Nama',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerwakilan(){
        return $this->hasOne(RefPerwakilan::className(), ['id' => 'perwakilan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanJawatankuasaPemilihan(){
        return $this->hasOne(RefJawatanJawatankuasaPemilihan::className(), ['id' => 'jawatan']);
    }
}
