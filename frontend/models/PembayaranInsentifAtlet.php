<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_insentif_atlet".
 *
 * @property integer $pembayaran_insentif_atlet_id
 * @property integer $pembayaran_insentif_id
 * @property integer $atlet
 * @property integer $negara
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranInsentifAtlet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_insentif_atlet';
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
            [['atlet', 'negara', 'acara', 'nilai', 'sukan', 'kelayakan_pingat', 'pingat', 'pembayaran_kepada'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'atlet', 'negara', 'created_by', 'updated_by', 'nama_bank', 'no_akaun_bank'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nilai', 'insentif_khas', 'insentif', 'rekod_baru'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            [['no_akaun_bank'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['pembayaran_insentif_id', 'atlet', 'acara', 'session_id'], 'unique', 'targetAttribute' => [ 'atlet', 'acara'] , 'message' => GeneralMessage::yii_validation_unique_multiple],
            [['no_akaun_bank','kelayakan_pingat','pingat','pembayaran_kepada'], function ($attribute, $params) {
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
            'pembayaran_insentif_atlet_id' => 'Pembayaran Insentif Atlet ID',
            'pembayaran_insentif_id' => 'Pembayaran Insentif ID',
            'atlet' => GeneralLabel::atlet,
            'acara' => GeneralLabel::acara,
            'negara' => GeneralLabel::bil_penyertaan_negara,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'nilai' => GeneralLabel::nilai,
            'insentif_khas'=> GeneralLabel::insentif_khas,
            'insentif' => GeneralLabel::insentif_rm,
            'sukan' => GeneralLabel::sukan,
            'kelayakan_pingat' => GeneralLabel::kelayakan_pingat,
            'pingat' => GeneralLabel::pingat,
            'rekod_baru' => GeneralLabel::rekod_baru_rm,
            'pembayaran_kepada' => GeneralLabel::pembayaran_kepada,
            'nama_bank' => GeneralLabel::nama_bank,
            'no_akaun_bank' => GeneralLabel::no_akaun_bank,
        ];
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
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPembayaranInsentif(){
        return $this->hasOne(PembayaranInsentif::className(), ['pembayaran_insentif_id' => 'pembayaran_insentif_id']);
    }
}
