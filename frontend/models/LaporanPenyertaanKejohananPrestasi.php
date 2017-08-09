<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_laporan_penyertaan_kejohanan_prestasi".
 *
 * @property integer $laporan_penyertaan_kejohanan_prestasi_id
 * @property integer $penyertaan_sukan_id
 * @property integer $atlet_id
 * @property string $acara
 * @property string $sasaran
 * @property string $pencapaian
 * @property string $catatan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPenyertaanKejohananPrestasi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_penyertaan_kejohanan_prestasi';
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
            [['penyertaan_sukan_id'], 'required'],
            [['penyertaan_sukan_id', 'atlet_id', 'acara', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['sasaran', 'pencapaian', 'catatan'], 'string', 'max' => 255],
            [['session_id'], 'string', 'max' => 100],
            [['sasaran', 'pencapaian', 'catatan'], 'filter', 'filter' => function ($value) {
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
            'laporan_penyertaan_kejohanan_prestasi_id' => 'Laporan Penyertaan Kejohanan Prestasi ID',
            'penyertaan_sukan_id' => 'Penyertaan Sukan ID',
            'atlet_id' => GeneralLabel::atlet,
            'acara' => GeneralLabel::acara,
            'sasaran' => GeneralLabel::sasaran,
            'pencapaian' => GeneralLabel::pencapaian,
            'catatan' => GeneralLabel::catatan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
