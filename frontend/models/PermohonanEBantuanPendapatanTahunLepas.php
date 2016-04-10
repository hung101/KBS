<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
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
            [['jenis_pendapatan', 'butir_butir', 'jumlah_pendapatan'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['jumlah_pendapatan'], 'number'],
            [['jenis_pendapatan'], 'string', 'max' => 80],
            [['butir_butir'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pendapatan_tahun_lepas_id' => GeneralLabel::pendapatan_tahun_lepas_id,
            'permohonan_e_bantuan_id' => GeneralLabel::permohonan_e_bantuan_id,
            'jenis_pendapatan' => GeneralLabel::jenis_pendapatan,
            'butir_butir' => GeneralLabel::butir_butir,
            'jumlah_pendapatan' => GeneralLabel::jumlah_pendapatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisPendapatan(){
        return $this->hasOne(RefJenisPendapatan::className(), ['id' => 'jenis_pendapatan']);
    }
}
