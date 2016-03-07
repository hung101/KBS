<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_kemudah_pakaian_peralatan_tiket".
 *
 * @property integer $kemudah_pakaian_peralatan_tiket_id
 * @property integer $atlet_id
 * @property string $kategori_permohonan
 * @property string $tarikh_diperlukan_pergi
 * @property string $tarikh_dijangka_dipulangkan_balik
 * @property string $destinasi_daripada
 * @property string $destinasi_ke
 * @property string $ulasan_permohonan
 * @property integer $kelulusan
 */
class KemudahPakaianPeralatanTiket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_kemudah_pakaian_peralatan_tiket';
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
            [['atlet_id', 'kategori_permohonan', 'tarikh_diperlukan_pergi', 'tarikh_dijangka_dipulangkan_balik', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['tarikh_diperlukan_pergi', 'tarikh_dijangka_dipulangkan_balik'], 'safe'],
            [['kategori_permohonan'], 'string', 'max' => 30],
            [['destinasi_daripada', 'destinasi_ke'], 'string', 'max' => 90],
            [['ulasan_permohonan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kemudah_pakaian_peralatan_tiket_id' => 'Kemudahan/Pakaian/Peralatan Tiket ID',
            'atlet_id' => 'Atlet',
            'kategori_permohonan' => 'Kategori Permohonan',
            'tarikh_diperlukan_pergi' => 'Tarikh Diperlukan/Pergi',
            'tarikh_dijangka_dipulangkan_balik' => 'Tarikh Dijangka Dipulangkan/Balik',
            'destinasi_daripada' => 'Destinasi Daripada',
            'destinasi_ke' => 'Destinasi Ke',
            'ulasan_permohonan' => 'Ulasan Permohonan',
            'kelulusan' => 'Kelulusan',
        ];
    }
}
