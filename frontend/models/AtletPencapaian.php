<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pencapaian".
 *
 * @property integer $pencapaian_id
 * @property integer $atlet_id
 * @property string $nama_kejohanan_temasya
 * @property string $peringkat_kejohanan
 * @property string $tarikh_mula_kejohanan
 * @property string $tarikh_tamat_kejohanan
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property string $lokasi_kejohanan
 * @property integer $insentif_id
 */
class AtletPencapaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian';
    }
    
    public function behaviors()
    {
        return [
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
            [['atlet_id', 'nama_kejohanan_temasya', 'peringkat_kejohanan', 'tarikh_mula_kejohanan', 'tarikh_tamat_kejohanan', 'nama_sukan', 'nama_acara', 'lokasi_kejohanan', 'pencapaian', 'jenis_rekod'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'insentif_id', 'penilaian_pestasi_id', 'nama_acara'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula_kejohanan', 'tarikh_tamat_kejohanan'], 'safe'],
            [['nama_kejohanan_temasya'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peringkat_kejohanan', 'nama_sukan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['nama_acara'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi_kejohanan'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kejohanan_temasya','peringkat_kejohanan', 'nama_sukan','lokasi_kejohanan'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pencapaian_id' => GeneralLabel::pencapaian_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_kejohanan_temasya' => GeneralLabel::nama_kejohanan_temasya,
            'peringkat_kejohanan' => GeneralLabel::peringkat,
            'tarikh_mula_kejohanan' => GeneralLabel::tarikh_mula,
            'tarikh_tamat_kejohanan' => GeneralLabel::tarikh_tamat,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'lokasi_kejohanan' => GeneralLabel::lokasi_kejohanan,
            'pencapaian' => GeneralLabel::pencapaian,
            'insentif_id' => GeneralLabel::insentif_id,
            'jenis_rekod' => GeneralLabel::jenis_rekod,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisRekod(){
        return $this->hasOne(RefJenisRekod::className(), ['id' => 'jenis_rekod']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKeputusan(){
        return $this->hasOne(RefKeputusan::className(), ['id' => 'pencapaian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPeringkatKejohananTemasya(){
        return $this->hasOne(RefPeringkatKejohananTemasya::className(), ['id' => 'peringkat_kejohanan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
