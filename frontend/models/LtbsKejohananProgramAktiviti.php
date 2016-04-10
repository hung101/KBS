<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ltbs_kejohanan_program_aktiviti".
 *
 * @property integer $kejohanan_program_aktiviti_id
 * @property string $nama_kejohanana_program_aktiviti_yang_disertai
 * @property string $tarikh_kejohanan_program_aktiviti_yang_disertai
 * @property integer $bilangan_peserta_yang_menyertai
 * @property string $kos_kejohanan_program_aktiviti_yang_disertai
 */
class LtbsKejohananProgramAktiviti extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ltbs_kejohanan_program_aktiviti';
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
            [['nama_kejohanana_program_aktiviti_yang_disertai', 'tarikh_kejohanan_program_aktiviti_yang_disertai', 'lokasi_tempat_kejohanan_program_aktiviti_yang_disertai', 'bilangan_peserta_yang_menyertai', 'kos_kejohanan_program_aktiviti_yang_disertai'], 'required', 'skipOnEmpty' => true],
            [['tarikh_kejohanan_program_aktiviti_yang_disertai'], 'safe'],
            [['lokasi_tempat_kejohanan_program_aktiviti_yang_disertai'], 'string', 'max' => 90],
            [['bilangan_peserta_yang_menyertai', 'profil_badan_sukan_id'], 'integer'],
            [['kos_kejohanan_program_aktiviti_yang_disertai'], 'number'],
            [['nama_kejohanana_program_aktiviti_yang_disertai'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'kejohanan_program_aktiviti_id' => GeneralLabel::kejohanan_program_aktiviti_id,
            'profil_badan_sukan_id' => GeneralLabel::profil_badan_sukan_id,
            'nama_kejohanana_program_aktiviti_yang_disertai' => GeneralLabel::nama_kejohanana_program_aktiviti_yang_disertai,
            'tarikh_kejohanan_program_aktiviti_yang_disertai' => GeneralLabel::tarikh_kejohanan_program_aktiviti_yang_disertai,
            'lokasi_tempat_kejohanan_program_aktiviti_yang_disertai' => GeneralLabel::lokasi_tempat_kejohanan_program_aktiviti_yang_disertai,
            'bilangan_peserta_yang_menyertai' => GeneralLabel::bilangan_peserta_yang_menyertai,
            'kos_kejohanan_program_aktiviti_yang_disertai' => GeneralLabel::kos_kejohanan_program_aktiviti_yang_disertai,

        ];
    }
}
