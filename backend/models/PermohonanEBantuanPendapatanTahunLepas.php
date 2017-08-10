<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

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
            //'bedezign\yii2\audit\AuditTrailBehavior',
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
            [['butir_butir'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['jenis_pendapatan','butir_butir'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
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
