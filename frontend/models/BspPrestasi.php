<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_prestasi".
 *
 * @property integer $bsp_prestasi_id
 * @property integer $bsp_pemohon_id
 * @property string $laporan_ulasan
 * @property string $nyatakan_sebab_sebab_tidak_menyertai_kejohanan
 */
class BspPrestasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_prestasi';
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
            [['bsp_pemohon_id'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['laporan_ulasan', 'nyatakan_sebab_sebab_tidak_menyertai_kejohanan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_prestasi_id' => GeneralLabel::bsp_prestasi_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'laporan_ulasan' => GeneralLabel::laporan_ulasan,
            'nyatakan_sebab_sebab_tidak_menyertai_kejohanan' => GeneralLabel::nyatakan_sebab_sebab_tidak_menyertai_kejohanan,

        ];
    }
}
