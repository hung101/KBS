<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bsp_pertukaran_program_pengajian".
 *
 * @property integer $bsp_pertukaran_program_pengajian_id
 * @property integer $bsp_pemohon_id
 * @property string $tarikh
 * @property string $bidang_pengajian_kursus
 * @property string $fakulti
 * @property string $tarikh_mula_pengajian
 * @property string $tarikh_tamat_pengajian
 * @property integer $tempoh_perlanjutan_semester
 */
class BspPertukaranProgramPengajian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bsp_pertukaran_program_pengajian';
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
            [['tarikh', 'bidang_pengajian_kursus', 'fakulti', 'tarikh_mula_pengajian', 'tarikh_tamat_pengajian', 'tempoh_perlanjutan_semester'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bsp_pemohon_id', 'tempoh_perlanjutan_semester'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'tarikh_mula_pengajian', 'tarikh_tamat_pengajian'], 'safe'],
            [['bidang_pengajian_kursus', 'fakulti'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['bidang_pengajian_kursus', 'fakulti'], 'filter', 'filter' => function ($value) {
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
            'bsp_pertukaran_program_pengajian_id' => GeneralLabel::bsp_pertukaran_program_pengajian_id,
            'bsp_pemohon_id' => GeneralLabel::bsp_pemohon_id,
            'tarikh' => GeneralLabel::tarikh,
            'bidang_pengajian_kursus' => GeneralLabel::bidang_pengajian_kursus,
            'fakulti' => GeneralLabel::fakulti,
            'tarikh_mula_pengajian' => GeneralLabel::tarikh_mula_pengajian,
            'tarikh_tamat_pengajian' => GeneralLabel::tarikh_tamat_pengajian,
            'tempoh_perlanjutan_semester' => GeneralLabel::tempoh_perlanjutan_semester,

        ];
    }
}
