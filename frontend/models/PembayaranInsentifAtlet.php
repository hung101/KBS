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
            [['atlet', 'negara'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'atlet', 'negara', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
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
            'atlet' => 'Atlet',
            'negara' => 'Negara',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
}
