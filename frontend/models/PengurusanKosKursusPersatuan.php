<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_perhimpunan_kem_kos".
 *
 * @property integer $pengurusan_perhimpunan_kem_kos_id
 * @property integer $kursus_persatuan_id
 * @property string $kategori_kos
 * @property string $anggaran_kos_per_kategori
 * @property string $revised_kos_per_kategori
 * @property string $approved_kos_per_kategori
 * @property string $catatan
 */
class PengurusanKosKursusPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kos_kursus_persatuan';
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
            [['kategori_kos', 'anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'required', 'skipOnEmpty' => true],
            [['kursus_persatuan_id'], 'integer'],
            [['anggaran_kos_per_kategori', 'revised_kos_per_kategori', 'approved_kos_per_kategori'], 'number'],
            [['kategori_kos'], 'string', 'max' => 30],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_perhimpunan_kem_kos_id' => 'Pengurusan Perhimpunan Kem Kos ID',
            'kursus_persatuan_id' => 'Pengurusan Perhimpunan Kem ID',
            'kategori_kos' => 'Kategori Kos',
            'anggaran_kos_per_kategori' => 'Anggaran Kos Per Kategori',
            'revised_kos_per_kategori' => 'Revised Kos Per Kategori',
            'approved_kos_per_kategori' => 'Approved Kos Per Kategori',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKosPerhimpunanKem(){
        return $this->hasOne(RefKategoriKosPerhimpunanKem::className(), ['id' => 'kategori_kos']);
    }
}
