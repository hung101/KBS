<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penganjuran_kursus_penganjur".
 *
 * @property integer $penganjuran_kursus_penganjur_id
 * @property string $kategori_kursus
 * @property string $nama_kursus
 * @property string $kod_kursus
 * @property string $tarikh
 * @property string $tempat
 */
class PenganjuranKursusPenganjur extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penganjuran_kursus_penganjur';
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
            [['kategori_kursus', 'nama_kursus', 'kod_kursus', 'tarikh', 'tempat'], 'required', 'skipOnEmpty' => true],
            [['tarikh'], 'safe'],
            [['kategori_kursus', 'nama_kursus'], 'string', 'max' => 80],
            [['kod_kursus'], 'string', 'max' => 30],
            [['tempat'], 'string', 'max' => 90]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penganjuran_kursus_penganjur_id' => GeneralLabel::penganjuran_kursus_penganjur_id,
            'kategori_kursus' => GeneralLabel::kategori_kursus,
            'nama_kursus' => GeneralLabel::nama_kursus,
            'kod_kursus' => GeneralLabel::kod_kursus,
            'tarikh' => GeneralLabel::tarikh,
            'tempat' => GeneralLabel::tempat,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKursusPenganjuran(){
        return $this->hasOne(RefKategoriKursusPenganjuran::className(), ['id' => 'kategori_kursus']);
    }
}
