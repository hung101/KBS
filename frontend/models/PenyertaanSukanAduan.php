<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penyertaan_sukan_aduan".
 *
 * @property integer $penyertaan_sukan_aduan_id
 * @property string $nama_pengadu
 * @property string $tarikh_aduan
 * @property string $status_aduan
 * @property string $aduan_kategori
 * @property string $penyataan_aduan
 */
class PenyertaanSukanAduan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan_aduan';
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
            [['nama_pengadu', 'tarikh_aduan', 'status_aduan', 'aduan_kategori', 'penyataan_aduan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_aduan'], 'safe'],
            [['nama_pengadu', 'aduan_kategori', 'penyataan_aduan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_aduan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pengadu', 'aduan_kategori', 'penyataan_aduan','status_aduan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penyertaan_sukan_aduan_id' => GeneralLabel::penyertaan_sukan_aduan_id,
            'nama_pengadu' => GeneralLabel::nama_pengadu,
            'tarikh_aduan' => GeneralLabel::tarikh_aduan,
            'status_aduan' => GeneralLabel::status_aduan,
            'aduan_kategori' => GeneralLabel::aduan_kategori,
            'penyataan_aduan' => GeneralLabel::penyataan_aduan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusAduanPenyertaanSukan(){
        return $this->hasOne(RefStatusAduanPenyertaanSukan::className(), ['id' => 'status_aduan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriAduanPenyertaanSukan(){
        return $this->hasOne(RefKategoriAduanPenyertaanSukan::className(), ['id' => 'aduan_kategori']);
    }
}
