<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_permohonan_inovasi_peralatan".
 *
 * @property integer $permohonan_inovasi_peralatan_id
 * @property string $tarikh_permohonan
 * @property string $pemohon
 * @property string $nama_peralatan
 * @property string $ringkasan_inovasi_peralatan
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 * @property string $status_permohonan
 */
class PermohonanInovasiPeralatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_permohonan_inovasi_peralatan';
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
            [['tarikh_permohonan', 'pemohon', 'nama_peralatan', 'ringkasan_inovasi_peralatan', 'pegawai_yang_bertanggungjawab', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['tarikh_permohonan'], 'safe'],
            [['pemohon', 'nama_peralatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80],
            [['ringkasan_inovasi_peralatan', 'catitan_ringkas'], 'string', 'max' => 255],
            [['status_permohonan'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'permohonan_inovasi_peralatan_id' => GeneralLabel::permohonan_inovasi_peralatan_id,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
            'pemohon' => GeneralLabel::pemohon,
            'nama_peralatan' => GeneralLabel::nama_peralatan,
            'ringkasan_inovasi_peralatan' => GeneralLabel::ringkasan_inovasi_peralatan,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'status_permohonan' => GeneralLabel::status_permohonan,

        ];
    }
}
