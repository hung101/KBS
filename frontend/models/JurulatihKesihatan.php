<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_jurulatih_kesihatan".
 *
 * @property integer $jurulatih_kesihatan_id
 * @property integer $jurulatih_id
 * @property string $tinggi
 * @property string $berat
 * @property string $masalah_kesihatan
 * @property string $catatan
 * @property string $pembedahan
 * @property string $alahan
 * @property string $sejarah_perubatan
 * @property string $kecacatan
 */
class JurulatihKesihatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_kesihatan';
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
            [['jurulatih_id', 'tinggi', 'berat'], 'required', 'skipOnEmpty' => true],
            [['jurulatih_id'], 'integer'],
            [['tinggi', 'berat'], 'number'],
            [['masalah_kesihatan', 'catatan', 'pembedahan', 'alahan', 'sejarah_perubatan', 'kecacatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_kesihatan_id' => 'Jurulatih Kesihatan ID',
            'jurulatih_id' => 'Jurulatih ID',
            'tinggi' => 'Tinggi',
            'berat' => 'Berat',
            'masalah_kesihatan' => 'Masalah Kesihatan',
            'catatan' => 'Catatan',
            'pembedahan' => 'Pembedahan',
            'alahan' => 'Alahan',
            'sejarah_perubatan' => 'Sejarah Perubatan',
            'kecacatan' => 'Kecacatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefMasalahKesihatan(){
        return $this->hasOne(RefMasalahKesihatan::className(), ['id' => 'masalah_kesihatan']);
    }
}
