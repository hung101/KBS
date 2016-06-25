<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_anugerah_ahli_jawantankuasa_pemilihan".
 *
 * @property integer $anugerah_ahli_jawantankuasa_pemilihan_id
 * @property string $perwakilan
 * @property string $nama
 * @property string $jawatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahAhliJawantankuasaPemilihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_ahli_jawantankuasa_pemilihan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perwakilan', 'nama', 'jawatan'], 'required'],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['perwakilan', 'nama', 'jawatan'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_ahli_jawantankuasa_pemilihan_id' => 'Anugerah Ahli Jawantankuasa Pemilihan ID',
            'perwakilan' => 'Perwakilan',
            'nama' => 'Nama',
            'jawatan' => 'Jawatan',
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
