<?php

namespace app\models;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use Yii;

/**
 * This is the model class for table "tbl_pembayaran_elaun_transaksi".
 *
 * @property integer $pembayaran_elaun_transaksi_id
 * @property integer $pembayaran_elaun_id
 * @property string $session_id
 * @property string $tarikh_pembayaran
 * @property string $jumlah
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranElaunTransaksi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_elaun_transaksi';
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
            [['pembayaran_elaun_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_pembayaran', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_elaun_transaksi_id' => 'Pembayaran Elaun Transaksi ID',
            'pembayaran_elaun_id' => 'Pembayaran Elaun ID',
            'session_id' => 'Session ID',
            'tarikh_pembayaran' => GeneralLabel::tarikh_pembayaran,
            'jumlah' => GeneralLabel::jumlah,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
