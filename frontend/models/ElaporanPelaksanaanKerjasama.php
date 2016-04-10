<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan_kerjasama".
 *
 * @property integer $elaporan_pelaksanaan_kerjasama_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $nama_kerjasama
 */
class ElaporanPelaksanaanKerjasama extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_elaporan_pelaksanaan_kerjasama';
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
            [['nama_kerjasama'], 'required', 'skipOnEmpty' => true],
            [['elaporan_pelaksaan_id'], 'integer'],
            [['nama_kerjasama'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksanaan_kerjasama_id' => GeneralLabel::elaporan_pelaksanaan_kerjasama_id,
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'nama_kerjasama' => GeneralLabel::nama_kerjasama,

        ];
    }
}
