<?php

namespace app\models;

use Yii;
use yii\web\Session;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penyertaan_sukan_acara".
 *
 * @property integer $penyertaan_sukan_acara_id
 * @property integer $penyertaan_sukan_id
 * @property string $nama_acara
 * @property string $tarikh_acara
 * @property string $keputusan_acara
 * @property integer $jumlah_pingat
 * @property integer $rekod_baru
 * @property string $catatan_rekod_baru
 */
class PenyertaanSukanAcara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan_acara';
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
            [['nama_acara', 'tarikh_acara', 'keputusan_acara', 'jumlah_pingat', 'rekod_baru', 'atlet'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['penyertaan_sukan_id', 'jumlah_pingat', 'rekod_baru', 'atlet', 'keputusan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['tarikh_acara'], 'safe'],
            [['nama_acara', 'keputusan_acara', 'sasaran'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan_rekod_baru', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_acara'],'validateTarikhAcara', 'skipOnEmpty' => false],
            [['nama_acara', 'keputusan_acara', 'sasaran','catatan_rekod_baru', 'catatan'], function ($attribute, $params) {
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
            'penyertaan_sukan_acara_id' => GeneralLabel::penyertaan_sukan_acara_id,
            'penyertaan_sukan_id' => GeneralLabel::penyertaan_sukan_id,
            'nama_acara' => GeneralLabel::nama_acara,
            'tarikh_acara' => GeneralLabel::tarikh_acara,
            'keputusan_acara' => GeneralLabel::keputusan_acara,
            'jumlah_pingat' => GeneralLabel::jumlah_pingat,
            'rekod_baru' => GeneralLabel::rekod_baru,
            'catatan_rekod_baru' => GeneralLabel::catatan_rekod_baru,
            'atlet' => GeneralLabel::atlet,
            'sasaran' => GeneralLabel::sasaran,
            'keputusan' => GeneralLabel::keputusan,
            'catatan' => GeneralLabel::catatan,
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateTarikhAcara($attribute, $params){
        
        $session = new Session;
        $session->open();
        
        $error_msg = '';

        if(isset($session['penyertaan-tarikh_mula']) && $session['penyertaan-tarikh_mula'] > $this->tarikh_acara){
            $error_msg = 'Tarikh tidak berada dalam tarikh kejohanan';
        }
        
        if(isset($session['penyertaan-tarikh_tamat']) && $session['penyertaan-tarikh_tamat'] < $this->tarikh_acara){
            $error_msg = 'Tarikh tidak berada dalam tarikh kejohanan';
        }
        
        if($error_msg != ''){
            $this->addError($attribute, $error_msg);
        }
        
        $session->close();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
}
