<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_perkhidmatan_permakanan".
 *
 * @property integer $permohonan_perkhidmatan_permakanan_id
 * @property integer $atlet_id
 * @property string $tarikh
 * @property string $sukan
 * @property string $tujuan
 * @property string $kategori_permohonan
 * @property string $jenis_perkhidmatan
 * @property integer $kelulusan
 */
class PermohonanPerkhidmatanPermakanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_perkhidmatan_permakanan';
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
            [['atlet_id', 'tarikh', 'sukan', 'tujuan', 'kategori_permohonan', 'jenis_perkhidmatan', 'kelulusan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id', 'kelulusan'], 'integer'],
            [['tarikh'], 'safe'],
            [['sukan', 'kategori_permohonan'], 'string', 'max' => 30],
            [['tujuan', 'jenis_perkhidmatan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_perkhidmatan_permakanan_id' => GeneralLabel::permohonan_perkhidmatan_permakanan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tarikh' => GeneralLabel::tarikh,
            'sukan' => GeneralLabel::sukan,
            'tujuan' => GeneralLabel::tujuan,
            'kategori_permohonan' => GeneralLabel::kategori_permohonan,
            'jenis_perkhidmatan' => GeneralLabel::jenis_perkhidmatan,
            'kelulusan' => GeneralLabel::kelulusan,

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
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
