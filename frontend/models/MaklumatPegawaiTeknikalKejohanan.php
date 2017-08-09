<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_maklumat_pegawai_teknikal_kejohanan".
 *
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id
 * @property integer $bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id
 * @property string $nama_kejohanan_kursus
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property integer $program
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class MaklumatPegawaiTeknikalKejohanan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_maklumat_pegawai_teknikal_kejohanan';
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
            [['nama_kejohanan_kursus', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'program'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id', 'program', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['nama_kejohanan_kursus'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_kejohanan_kursus','tempat'], 'filter', 'filter' => function ($value) {
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
            'bantuan_penganjuran_kursus_pegawai_teknikal_kejohanan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Kejohanan ID',
            'bantuan_penganjuran_kursus_pegawai_teknikal_dicadangkan_id' => 'Bantuan Penganjuran Kursus Pegawai Teknikal Dicadangkan ID',
            'nama_kejohanan_kursus' => GeneralLabel::nama_kejohanan_kursus,
            'tarikh_mula' => GeneralLabel::tarikh_mula,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'tempat' => GeneralLabel::tempat,
            'program' => GeneralLabel::program,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramPengawaiTeknikal(){
        return $this->hasOne(RefProgramPengawaiTeknikal::className(), ['id' => 'program']);
    }
}
