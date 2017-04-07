<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_mesyuarat_senarai_tugas".
 *
 * @property integer $senarai_tugas_id
 * @property integer $mesyuarat_id
 * @property string $name_tugas
 * @property string $tarikh_tamat
 * @property string $pegawai
 * @property integer $atlet_id
 * @property string $persatuan
 * @property string $status
 */
class MesyuaratSenaraiTugas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mesyuarat_senarai_tugas';
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
            [['name_tugas', 'tarikh_tamat', 'pegawai', 'status'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['mesyuarat_id', 'atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_tamat'], 'safe'],
            [['name_tugas', 'persatuan'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pegawai'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'senarai_tugas_id' => GeneralLabel::senarai_tugas_id,
            'mesyuarat_id' => GeneralLabel::mesyuarat_id,
            'name_tugas' => GeneralLabel::name_tugas,
            'tarikh_tamat' => GeneralLabel::tarikh_tamat,
            'pegawai' => GeneralLabel::pegawai,
            'atlet_id' => GeneralLabel::atlet_id,
            'persatuan' => GeneralLabel::persatuan,
            'status' => GeneralLabel::status,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefMesyuaratSenaraiNamaHadir(){
        return $this->hasOne(MesyuaratSenaraiNamaHadir::className(), ['senarai_nama_hadir_id' => 'pegawai']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
