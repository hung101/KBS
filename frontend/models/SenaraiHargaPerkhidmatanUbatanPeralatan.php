<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_senarai_harga_perkhidmatan_ubatan_peralatan".
 *
 * @property integer $senarai_harga_perkhidmatan_ubatan_peralatan_id
 * @property string $nama_perkhidmatan_ubatan_peralatan
 * @property string $harga
 * @property string $catitan_ringkas
 */
class SenaraiHargaPerkhidmatanUbatanPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_senarai_harga_perkhidmatan_ubatan_peralatan';
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
            [['nama_perkhidmatan_ubatan_peralatan', 'harga'], 'required', 'skipOnEmpty' => true],
            [['harga'], 'number'],
            [['nama_perkhidmatan_ubatan_peralatan'], 'string', 'max' => 80],
            [['catitan_ringkas'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_harga_perkhidmatan_ubatan_peralatan_id' => 'Senarai Harga Perkhidmatan Ubatan Peralatan ID',
            'nama_perkhidmatan_ubatan_peralatan' => 'Nama Perkhidmatan/Ubatan/Peralatan',
            'harga' => 'Harga Tab/ML/Botol/Perkhidmatan/Unit',
            'catitan_ringkas' => 'Catitan Ringkas',
        ];
    }
}
