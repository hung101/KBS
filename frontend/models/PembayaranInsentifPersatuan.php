<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_insentif_persatuan".
 *
 * @property integer $pembayaran_insentif_persatuan_id
 * @property integer $pembayaran_insentif_id
 * @property integer $persatuan
 * @property integer $nama_bank
 * @property integer $no_akaun_bank
 * @property string $nilai
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranInsentifPersatuan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_insentif_persatuan';
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
            [['persatuan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pembayaran_insentif_id', 'persatuan', 'nama_bank', 'no_akaun_bank', 'created_by', 'updated_by'], 'integer'],
            [['nilai'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            [['no_akaun_bank'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_insentif_persatuan_id' => 'Pembayaran Insentif Persatuan ID',
            'pembayaran_insentif_id' => 'Pembayaran Insentif ID',
            'persatuan' => GeneralLabel::persatuan,
            'nama_bank' => GeneralLabel::nama_bank,
            'no_akaun_bank' => GeneralLabel::no_akaun_bank,
            'nilai' => GeneralLabel::nilai,
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
    public function getRefProfilBadanSukan(){
        return $this->hasOne(ProfilBadanSukan::className(), ['profil_badan_sukan' => 'persatuan']);
    }
}
