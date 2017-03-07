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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet', 'negara', 'acara', 'nilai', 'sukan', 'kelayakan_pingat', 'pingat', 'pembayaran_kepada'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'atlet', 'negara', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['nilai', 'insentif_khas', 'insentif', 'rekod_baru'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            //[['pembayaran_insentif_id', 'atlet', 'acara', 'session_id'], 'unique', 'targetAttribute' => [ 'atlet', 'acara'] , 'message' => GeneralMessage::yii_validation_unique_multiple],
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
}
