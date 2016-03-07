<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_mesyuarat_senarai_nama_hadir".
 *
 * @property integer $senarai_nama_hadir_id
 * @property integer $mesyuarat_id
 * @property string $nama
 * @property integer $kehadiran
 */
class MesyuaratSenaraiNamaHadir extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mesyuarat_senarai_nama_hadir';
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
            [['nama', 'status', 'no_tel', 'jawatan', 'organisasi', 'kehadiran'], 'required', 'skipOnEmpty' => true],
            [['mesyuarat_id', 'kehadiran'], 'integer'],
            [['emel'], 'email'],
            [['nama'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_nama_hadir_id' => 'Senarai Nama Hadir ID',
            'mesyuarat_id' => 'Mesyuarat ID',
            'nama' => 'Nama',
            'status' => 'Status',
            'jawatan' => 'Jawatan',
            'organisasi' => 'Organisasi',
            'no_tel' => 'No Tel',
            'emel' => 'Emel',
            'kehadiran' => 'Kehadiran',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kehadiran']);
    }
}
