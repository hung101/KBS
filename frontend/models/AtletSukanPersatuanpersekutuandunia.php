<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_sukan_persatuanpersekutuandunia".
 *
 * @property integer $persatuan_persekutuan_dunia_id
 * @property integer $atlet_id
 * @property string $jenis
 * @property string $name_persatuan_persekutuan_dunian
 * @property string $alamat_1
 * @property string $no_telefon
 * @property string $emel
 * @property string $laman_web
 */
class AtletSukanPersatuanpersekutuandunia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_sukan_persatuanpersekutuandunia';
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
            [['atlet_id', 'jenis', 'name_persatuan_persekutuan_dunia', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jenis', 'alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 30],
            [['name_persatuan_persekutuan_dunia', 'emel'], 'string', 'max' => 100],
            [['no_telefon'], 'string', 'max' => 14],
            [['laman_web'], 'string', 'max' => 120]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'persatuan_persekutuan_dunia_id' => 'Persatuan Persekutuan Dunia ID',
            'atlet_id' => 'Atlet ID',
            'jenis' => 'Jenis',
            'name_persatuan_persekutuan_dunia' => 'Nama Persatuan / Persekutuan Dunia',
            'alamat_1' => 'Alamat',
            'alamat_2' => '',
            'alamat_3' => '',
            'alamat_negeri' => 'Negeri',
            'alamat_bandar' => 'Bandar',
            'alamat_poskod' => 'Poskod',
            'no_telefon' => 'No Telefon',
            'emel' => 'Emel',
            'laman_web' => 'Laman Web',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisSukanPersatuanPersekutuandunia(){
        return $this->hasOne(RefJenisSukanPersatuanPersekutuandunia::className(), ['id' => 'jenis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNamaSukanPersatuanPersekutuandunia(){
        return $this->hasOne(RefNamaSukanPersatuanPersekutuandunia::className(), ['id' => 'name_persatuan_persekutuan_dunia']);
    }
}
