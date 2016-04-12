<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_pendapatan_tahun_lepas".
 *
 * @property integer $pendapatan_tahun_lepas_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $jenis_pendapatan
 * @property string $butir_butir
 * @property string $jumlah_pendapatan
 */
class PermohonanEBantuanPendapatanTahunLepas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_pendapatan_tahun_lepas';
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
            [['jenis_pendapatan', 'butir_butir', 'jumlah_pendapatan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['permohonan_e_bantuan_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jumlah_pendapatan'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['jenis_pendapatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['butir_butir'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pendapatan_tahun_lepas_id' => 'Pendapatan Tahun Lepas ID',
            'permohonan_e_bantuan_id' => 'Permohonan E Bantuan ID',
            'jenis_pendapatan' => 'Jenis Pendapatan',
            'butir_butir' => 'Butir-butir',
            'jumlah_pendapatan' => 'Jumlah Pendapatan (RM)',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisPendapatan(){
        return $this->hasOne(RefJenisPendapatan::className(), ['id' => 'jenis_pendapatan']);
    }
}
