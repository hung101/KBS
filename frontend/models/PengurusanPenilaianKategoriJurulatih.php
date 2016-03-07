<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_penilaian_kategori_jurulatih".
 *
 * @property integer $pengurusan_penilaian_kategori_jurulatih_id
 * @property integer $pengurusan_pemantauan_dan_penilaian_jurulatih_id
 * @property string $penilaian_kategori
 * @property string $penilaian_sub_kategori
 * @property integer $markah_penilaian
 */
class PengurusanPenilaianKategoriJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penilaian_kategori_jurulatih';
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
            [['penilaian_kategori', 'penilaian_sub_kategori', 'markah_penilaian'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'markah_penilaian'], 'integer'],
            [['penilaian_kategori', 'penilaian_sub_kategori'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_penilaian_kategori_jurulatih_id' => 'Pengurusan Penilaian Kategori Jurulatih ID',
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => 'Pengurusan Penilaian Jurulatih ID',
            'penilaian_kategori' => 'Kategori',
            'penilaian_sub_kategori' => 'Sub Kategori',
            'markah_penilaian' => 'Markah Penilaian',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPenilaianJurulatih(){
        return $this->hasOne(RefKategoriPenilaianJurulatih::className(), ['id' => 'penilaian_kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubKategoriPenilaianJurulatih(){
        return $this->hasOne(RefSubKategoriPenilaianJurulatih::className(), ['id' => 'penilaian_sub_kategori']);
    }
}
