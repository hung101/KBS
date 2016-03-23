<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_elaun_jurulatih".
 *
 * @property integer $elaun_jurulatih_id
 * @property integer $gaji_dan_elaun_jurulatih_id
 * @property string $jenis_elaun
 * @property string $jumlah_elaun
 */
class ElaunJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaun_jurulatih';
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
            [['jenis_elaun', 'jumlah_elaun'], 'required', 'skipOnEmpty' => true],
            [['elaun_jurulatih_id', 'gaji_dan_elaun_jurulatih_id'], 'integer'],
            [['jumlah_elaun'], 'number'],
            [['jenis_elaun'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaun_jurulatih_id' => GeneralLabel::elaun_jurulatih_id,
            'gaji_dan_elaun_jurulatih_id' => GeneralLabel::gaji_dan_elaun_jurulatih_id,
            'jenis_elaun' => GeneralLabel::jenis_elaun,
            'jumlah_elaun' => GeneralLabel::jumlah_elaun,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisElaunJurulatih(){
        return $this->hasOne(RefJenisElaunJurulatih::className(), ['id' => 'jenis_elaun']);
    }
}
