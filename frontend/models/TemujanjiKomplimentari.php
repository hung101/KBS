<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_temujanji_komplimentari".
 *
 * @property integer $temujanji_komplimentari_id
 * @property integer $atlet_id
 * @property string $perkhidmatan
 * @property string $tarikh_khidmat
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $status_temujanji
 * @property string $catitan_ringkas
 */
class TemujanjiKomplimentari extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_temujanji_komplimentari';
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
            [['atlet_id','jantina', 'jenis_sukan', 'perkhidmatan', 'tarikh_khidmat','lokasi', 'pegawai_yang_bertanggungjawab', 'status_temujanji'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_khidmat'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['status_temujanji'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'temujanji_komplimentari_id' => GeneralLabel::temujanji_komplimentari_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jantina' => GeneralLabel::jantina,
            'jenis_sukan' => GeneralLabel::jenis_sukan,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'tarikh_khidmat' => GeneralLabel::tarikh_khidmat,
            'lokasi' => GeneralLabel::lokasi,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'status_temujanji' => GeneralLabel::status_temujanji,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPerkhidmatanKomplimentari(){
        return $this->hasOne(RefPerkhidmatanKomplimentari::className(), ['id' => 'perkhidmatan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJuruUrut(){
        return $this->hasOne(RefJuruUrut::className(), ['id' => 'pegawai_yang_bertanggungjawab']);
    }
}
