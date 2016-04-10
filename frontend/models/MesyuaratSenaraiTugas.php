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
            [['name_tugas', 'tarikh_tamat', 'pegawai', 'atlet_id', 'status'], 'required', 'skipOnEmpty' => true],
            [['mesyuarat_id', 'atlet_id'], 'integer'],
            [['tarikh_tamat'], 'safe'],
            [['name_tugas', 'persatuan'], 'string', 'max' => 100],
            [['pegawai'], 'string', 'max' => 20],
            [['status'], 'string', 'max' => 30]
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
    public function getRefMesyuaratPegawai(){
        return $this->hasOne(RefMesyuaratPegawai::className(), ['id' => 'pegawai']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
