<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_borang_penilaian_kaunseling".
 *
 * @property integer $borang_penilaian_kaunseling_id
 * @property integer $profil_konsultan_id
 * @property string $diagnosis
 * @property string $preskripsi
 * @property string $cadangan
 * @property string $rujukan
 * @property string $tindakan_selanjutnya
 * @property string $kategori_permasalahan
 * @property string $tarikh_temujanji
 */
class BorangPenilaianKaunseling extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_borang_penilaian_kaunseling';
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
            [['profil_konsultan_id', 'atlet', 'diagnosis', 'kategori_permasalahan'], 'required', 'skipOnEmpty' => true],
            [['profil_konsultan_id', 'atlet'], 'integer'],
            [['tarikh_temujanji'], 'safe'],
            [['diagnosis', 'preskripsi', 'cadangan', 'rujukan', 'tindakan_selanjutnya', 'kategori_permasalahan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'borang_penilaian_kaunseling_id' => GeneralLabel::borang_penilaian_kaunseling_id,
            'profil_konsultan_id' => GeneralLabel::profil_konsultan_id,
            'atlet' => GeneralLabel::atlet,
            'diagnosis' => GeneralLabel::diagnosis,
            'preskripsi' => GeneralLabel::preskripsi,
            'cadangan' => GeneralLabel::cadangan,
            'rujukan' => GeneralLabel::rujukan,
            'tindakan_selanjutnya' => GeneralLabel::tindakan_selanjutnya,
            'kategori_permasalahan' => GeneralLabel::kategori_permasalahan,
            'tarikh_temujanji' => GeneralLabel::tarikh_temujanji,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefUser(){
        return $this->hasOne(User::className(), ['id' => 'profil_konsultan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriMasalahKaunseling(){
        return $this->hasOne(RefKategoriMasalahKaunseling::className(), ['id' => 'kategori_permasalahan']);
    }
}
