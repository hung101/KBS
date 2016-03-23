<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ltbs_senarai_nama_hadir_agm".
 *
 * @property integer $senarai_nama_hadir_id
 * @property integer $mesyuarat_agm_id
 * @property string $nama_penuh
 * @property string $no_kad_pengenalan
 * @property string $jantina
 * @property string $jawatan
 * @property string $kategori_keahlian
 * @property integer $kehadiran
 */
class LtbsSenaraiNamaHadirAgm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_senarai_nama_hadir_agm';
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
            [['nama_penuh', 'no_kad_pengenalan', 'jantina', 'kategori_keahlian'], 'required', 'skipOnEmpty' => true],
            [['mesyuarat_agm_id', 'kehadiran'], 'integer'],
            [['nama_penuh'], 'string', 'max' => 100],
            [['no_kad_pengenalan'], 'string', 'max' => 12],
            [['jantina'], 'string', 'max' => 1],
            [['jawatan'], 'string', 'max' => 50],
            [['kategori_keahlian'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_nama_hadir_id' => GeneralLabel::senarai_nama_hadir_id,
            'mesyuarat_agm_id' => GeneralLabel::mesyuarat_agm_id,
            'nama_penuh' => GeneralLabel::nama_penuh,
            'no_kad_pengenalan' => GeneralLabel::no_kad_pengenalan,
            'jantina' => GeneralLabel::jantina,
            'jawatan' => GeneralLabel::jawatan,
            'kategori_keahlian' => GeneralLabel::kategori_keahlian,
            'kehadiran' => GeneralLabel::kehadiran,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriKeahlian(){
        return $this->hasOne(RefKategoriKeahlian::className(), ['id' => 'kategori_keahlian']);
    }
}
