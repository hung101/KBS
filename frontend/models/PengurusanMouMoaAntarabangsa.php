<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_mou_moa_antarabangsa".
 *
 * @property integer $pengurusan_mou_moa_antarabangsa_id
 * @property string $nama_negara_terlibat
 * @property string $agensi
 * @property string $asas_asas_pertimbangan
 * @property string $jangka_waktu_mula
 * @property string $jangka_waktu_tamat
 * @property string $status
 * @property string $tajuk_mou_moa
 * @property string $catatan
 */
class PengurusanMouMoaAntarabangsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_mou_moa_antarabangsa';
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
            [['nama_negara_terlibat', 'agensi', 'jangka_waktu_mula', 'jangka_waktu_tamat', 'status', 'tajuk_mou_moa'], 'required', 'skipOnEmpty' => true],
            [['jangka_waktu_mula', 'jangka_waktu_tamat'], 'safe'],
            [['nama_negara_terlibat', 'agensi', 'tajuk_mou_moa'], 'string', 'max' => 80],
            [['asas_asas_pertimbangan', 'catatan'], 'string', 'max' => 255],
            [['status'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_mou_moa_antarabangsa_id' => GeneralLabel::pengurusan_mou_moa_antarabangsa_id,
            'nama_negara_terlibat' => GeneralLabel::nama_negara_terlibat,
            'agensi' => GeneralLabel::agensi,
            'asas_asas_pertimbangan' => GeneralLabel::asas_asas_pertimbangan,
            'jangka_waktu_mula' => GeneralLabel::jangka_waktu_mula,
            'jangka_waktu_tamat' => GeneralLabel::jangka_waktu_tamat,
            'status' => GeneralLabel::status,
            'tajuk_mou_moa' => GeneralLabel::tajuk_mou_moa,
            'catatan' => GeneralLabel::catatan,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'nama_negara_terlibat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAgensiAntarabangsa(){
        return $this->hasOne(RefAgensiAntarabangsa::className(), ['id' => 'agensi']);
    }
}
