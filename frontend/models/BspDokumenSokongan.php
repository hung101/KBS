<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_dokumen_sokongan".
 *
 * @property integer $bsp_dokumen_sokongan_id
 * @property integer $bsp_pemohon_id
 * @property string $nama_dokumen
 * @property string $upload
 */
class BspDokumenSokongan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_dokumen_sokongan';
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
            [['bsp_pemohon_id', 'nama_dokumen', 'upload'], 'required', 'skipOnEmpty' => true],
            [['bsp_pemohon_id'], 'integer'],
            [['nama_dokumen'], 'string', 'max' => 80],
            [['upload'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bsp_dokumen_sokongan_id' => GeneralLabel::bsp_dokumen_sokongan_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'nama_dokumen' => GeneralLabel::nama_dokumen,
            'upload' => GeneralLabel::upload,

        ];
    }
}
