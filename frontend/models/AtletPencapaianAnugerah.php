<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_pencapaian_anugerah".
 *
 * @property integer $anugerah_id
 * @property integer $atlet_id
 * @property string $tahun
 * @property string $nama_acara
 * @property string $kategori
 * @property integer $insentif_id
 */
class AtletPencapaianAnugerah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian_anugerah';
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
            [['atlet_id', 'tahun', 'nama_acara'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'insentif_id'], 'integer'],
            [['tahun'], 'integer'],
            [['tahun'], 'string', 'max' => 4],
            [['nama_acara'], 'string', 'max' => 100],
            [['remark'], 'string', 'max' => 255],
            [['kategori'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_id' => GeneralLabel::anugerah_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tahun' => GeneralLabel::tahun,
            'nama_acara' => GeneralLabel::nama_acara,
            'kategori' => GeneralLabel::kategori,
            'remark' => GeneralLabel::remark,
            'insentif_id' => GeneralLabel::insentif_id,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriAnugerah(){
        return $this->hasOne(RefKategoriAnugerah::className(), ['id' => 'kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
