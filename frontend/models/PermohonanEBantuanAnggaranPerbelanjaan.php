<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_e_bantuan_anggaran_perbelanjaan".
 *
 * @property integer $anggaran_perbelanjaan_id
 * @property integer $permohonan_e_bantuan_id
 * @property string $butir_butir_perbelanjaan
 * @property string $jumlah_perbelanjaan
 */
class PermohonanEBantuanAnggaranPerbelanjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_e_bantuan_anggaran_perbelanjaan';
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
            [['butir_butir_perbelanjaan', 'jumlah_perbelanjaan'], 'required', 'skipOnEmpty' => true],
            [['permohonan_e_bantuan_id'], 'integer'],
            [['jumlah_perbelanjaan', 'jumlah_disokong', 'jumlah_diperakuankan'], 'number'],
            [['butir_butir_perbelanjaan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anggaran_perbelanjaan_id' => GeneralLabel::anggaran_perbelanjaan_id,
            'permohonan_e_bantuan_id' => GeneralLabel::permohonan_e_bantuan_id,
            'butir_butir_perbelanjaan' => GeneralLabel::butir_butir_perbelanjaan,
            'jumlah_perbelanjaan' => GeneralLabel::jumlah_perbelanjaan,
            'jumlah_disokong' => GeneralLabel::jumlah_disokong,
            'jumlah_diperakuankan' => GeneralLabel::jumlah_diperakuankan,

        ];
    }
}
