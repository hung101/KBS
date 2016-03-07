<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pertukaran_pengajian".
 *
 * @property integer $pertukaran_pengajian_id
 * @property integer $atlet_id
 * @property string $sebab_pemohonan
 * @property string $kategori_pengajian
 * @property string $nama_pengajian_sekarang
 * @property string $nama_pertukaran_pengajian
 * @property string $sebab_pertukaran
 * @property string $sebab_penangguhan
 */
class PertukaranPengajian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pertukaran_pengajian';
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
            [['atlet_id', 'sebab_pemohonan', 'kategori_pengajian', 'nama_pengajian_sekarang', 'nama_pertukaran_pengajian'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['sebab_pemohonan', 'sebab_pertukaran', 'sebab_penangguhan'], 'string', 'max' => 255],
            [['kategori_pengajian'], 'string', 'max' => 30],
            [['nama_pengajian_sekarang', 'nama_pertukaran_pengajian'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pertukaran_pengajian_id' => 'Pertukaran Pengajian ID',
            'atlet_id' => 'Atlet',
            'sebab_pemohonan' => 'Sebab Pemohonan',
            'kategori_pengajian' => 'Kategori Pengajian',
            'nama_pengajian_sekarang' => 'Nama Institusi Pengajian Sekarang',
            'nama_pertukaran_pengajian' => 'Nama Pertukaran Institusi Pengajian',
            'sebab_pertukaran' => 'Sebab Pertukaran',
            'sebab_penangguhan' => 'Sebab Penangguhan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengajian(){
        return $this->hasOne(RefPengajian::className(), ['id' => 'nama_pertukaran_pengajian']);
    }
}
