<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_elaporan_pelaksanaan_kekurangan".
 *
 * @property integer $elaporan_pelaksanaan_kekurangan_id
 * @property integer $elaporan_pelaksaan_id
 * @property string $kekurangan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ElaporanPelaksanaanKekurangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_elaporan_pelaksanaan_kekurangan';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['elaporan_pelaksaan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kekurangan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'elaporan_pelaksanaan_kekurangan_id' => GeneralLabel::elaporan_pelaksanaan_kekurangan_id,
            'elaporan_pelaksaan_id' => GeneralLabel::elaporan_pelaksaan_id,
            'kekurangan' => GeneralLabel::kekurangan,
            'session_id' => GeneralLabel::session_id,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
}
