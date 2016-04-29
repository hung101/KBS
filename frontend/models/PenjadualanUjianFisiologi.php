<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penjadualan_ujian_fisiologi".
 *
 * @property integer $penjadualan_ujian_fisiologi_id
 * @property integer $atlet_id
 * @property string $perkhidmatan
 * @property string $tarikh_masa
 * @property string $pegawai_yang_bertanggungjawab
 * @property string $catitan_ringkas
 */
class PenjadualanUjianFisiologi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penjadualan_ujian_fisiologi';
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
            [['perkhidmatan', 'tarikh_masa', 'pegawai_yang_bertanggungjawab', 'kategori_sukan', 'sukan', 'acara', 'tempat', 'bilangan_atlet'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'kategori_sukan', 'sukan', 'acara', 'tempat', 'bilangan_atlet'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            //[['bilangan_atlet'], 'integer', 'min' => 1, 'max' => 100, 'tooBig' => GeneralMessage::yii_validation_integer_max, 'tooSmall' => GeneralMessage::yii_validation_integer_min],
            [['tarikh_masa'], 'safe'],
            [['perkhidmatan', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catitan_ringkas', 'ujian'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penjadualan_ujian_fisiologi_id' => GeneralLabel::penjadualan_ujian_fisiologi_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'perkhidmatan' => GeneralLabel::perkhidmatan,
            'tarikh_masa' => GeneralLabel::tarikh_masa,
            'pegawai_yang_bertanggungjawab' => GeneralLabel::pegawai_yang_bertanggungjawab,
            'catitan_ringkas' => GeneralLabel::catitan_ringkas,
            'kategori_sukan' => GeneralLabel::kategori_sukan,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'tempat' => GeneralLabel::tempat,
            'bilangan_atlet' => GeneralLabel::bilangan_atlet,
            'ujian' => GeneralLabel::ujian,
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
    public function getRefPerkhidmatanFisiologi(){
        return $this->hasOne(RefPerkhidmatanFisiologi::className(), ['id' => 'perkhidmatan']);
    }
}
