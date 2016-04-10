<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_senarai_aktiviti_projek".
 *
 * @property integer $senarai_aktiviti_projek_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $nama_aktiviti_projek
 * @property string $keterangan_ringkas
 * @property string $kejayaan_yang_dicapai
 */
class PermohonanEBantuanSenaraiAktivitiProjek extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_senarai_aktiviti_projek';
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
            [['permohonan_e_bantuan_id', 'nama_aktiviti_projek', 'keterangan_ringkas'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['nama_aktiviti_projek'], 'string', 'max' => 80],
            [['keterangan_ringkas'], 'string', 'max' => 255],
            [['kejayaan_yang_dicapai'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_aktiviti_projek_id' => GeneralLabel::senarai_aktiviti_projek_id,
            'permohonan_e_bantuan_id' => GeneralLabel::permohonan_e_bantuan_id,
            'nama_aktiviti_projek' => GeneralLabel::nama_aktiviti_projek,
            'keterangan_ringkas' => GeneralLabel::keterangan_ringkas,
            'kejayaan_yang_dicapai' => GeneralLabel::kejayaan_yang_dicapai,

        ];
    }
}
