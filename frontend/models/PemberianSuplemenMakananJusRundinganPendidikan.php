<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan".
 *
 * @property integer $pemberian_suplemen_makanan_jus_rundingan_pendidikan_id
 * @property integer $perkhidmatan_permakanan_id
 * @property string $nama_suplemen_makanan_jus_rundingan_pendidikan
 * @property integer $kuantiti_ml_g
 * @property string $harga
 */
class PemberianSuplemenMakananJusRundinganPendidikan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pemberian_suplemen_makanan_jus_rundingan_pendidikan';
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
            [['atlet', 'nama_suplemen_makanan_jus_rundingan_pendidikan', 'kuantiti_ml_g', 'harga'], 'required', 'skipOnEmpty' => true],
            [['perkhidmatan_permakanan_id', 'kuantiti_ml_g', 'kategori_atlet', 'acara', 'sukan'], 'integer'],
            [['nama_suplemen_makanan_jus_rundingan_pendidikan'], 'safe'],
            [['harga'], 'number'],
            [['nama_suplemen_makanan_jus_rundingan_pendidikan'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pemberian_suplemen_makanan_jus_rundingan_pendidikan_id' => 'Pemberian Suplemen/Makanan/Jus/Rundingan/Pendidikan ID',
            'perkhidmatan_permakanan_id' => 'Perkhidmatan Permakanan ID',
            'kategori_atlet' => 'Kategori Atlet',
            'sukan' => 'Sukan',
            'acara' => 'Acara',
            'atlet' => 'Atlet',
            'nama_suplemen_makanan_jus_rundingan_pendidikan' => 'Nama Suplemen/Jus',
            'kuantiti_ml_g' => 'Kuantiti/ml/g',
            'harga' => 'Harga',
        ];
    }
}
