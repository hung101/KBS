<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_tempahan_kursus_persatuan".
 *
 * @property integer $tempahan_kursus_persatuan_id
 * @property integer $kursus_persatuan_id
 * @property string $tarikh
 * @property string $jenis_tempahan
 * @property integer $unit_tempahan
 * @property string $kos_tempahan
 */
class TempahanKursusPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_tempahan_kursus_persatuan';
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
            [['tarikh', 'jenis_tempahan', 'unit_tempahan', 'kos_tempahan'], 'required', 'skipOnEmpty' => true],
            [['kursus_persatuan_id', 'unit_tempahan'], 'integer'],
            [['tarikh'], 'safe'],
            [['kos_tempahan'], 'number'],
            [['jenis_tempahan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tempahan_kursus_persatuan_id' => 'Tempahan Kursus Persatuan ID',
            'kursus_persatuan_id' => 'Kursus Persatuan ID',
            'tarikh' => 'Tarikh',
            'jenis_tempahan' => 'Jenis Tempahan',
            'unit_tempahan' => 'Unit Tempahan',
            'kos_tempahan' => 'Kos Tempahan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisTempahanKursusPersatuan(){
        return $this->hasOne(RefJenisTempahanKursusPersatuan::className(), ['id' => 'jenis_tempahan']);
    }
}
