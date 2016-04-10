<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_insuran".
 *
 * @property integer $pengurusan_insuran_id
 * @property integer $atlet_id
 * @property string $nama_insuran
 * @property string $jumlah_tuntutan
 * @property string $tarikh_tuntutan
 * @property string $pegawai_yang_bertanggungjawab
 */
class PengurusanInsuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insuran';
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
            [['atlet_id', 'nama_insuran', 'jumlah_tuntutan', 'tarikh_tuntutan', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jumlah_tuntutan'], 'number'],
            [['tarikh_tuntutan', 'catatan'], 'safe'],
            [['nama_insuran', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insuran_id' => GeneralLabel::pengurusan_insuran_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'nama_insuran' => GeneralLabel::nama_insuran,
            'jumlah_tuntutan' => GeneralLabel::jumlah_tuntutan,
            'tarikh_tuntutan' => GeneralLabel::tarikh_tuntutan,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
