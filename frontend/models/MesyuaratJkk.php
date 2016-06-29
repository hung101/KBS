<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_mesyuarat".
 *
 * @property integer $mesyuarat_id
 * @property string $bil_mesyuarat
 * @property string $tarikh
 * @property string $masa
 * @property string $tempat
 * @property string $pengurusi
 * @property string $pencatat_minit
 * @property string $perkara_perkara_dan_tindakan
 * @property string $mesyuarat_tamat
 * @property string $mesyuarat_seterusnya
 * @property string $disedia_oleh
 * @property string $disemak_oleh
 */
class MesyuaratJkk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_mesyuarat_jkk';
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
            [['bil_mesyuarat', 'nama_mesyuarat', 'agenda', 'tarikh', 'tempat', 'disedia_oleh', 'disemak_oleh', 'sukan', 'fasa', 'cawangan', 'program', 'negeri',
                'penganjur', 'pengerusi_mesyuarat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh'], 'safe'],
            [['bil_mesyuarat'], 'string', 'max' => 20, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pengurusi', 'pencatat_minit', 'perkara_perkara_dan_tindakan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['mesyuarat_tamat', 'mesyuarat_seterusnya', 'disedia_oleh', 'disemak_oleh'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'mesyuarat_id' => GeneralLabel::mesyuarat_id,
            'nama_mesyuarat' => GeneralLabel::nama_mesyuarat,
            'agenda' => GeneralLabel::agenda,
            'bil_mesyuarat' => GeneralLabel::bil_mesyuarat,
            'tarikh' => GeneralLabel::tarikh,
            'masa' => GeneralLabel::masa,
            'tempat' => GeneralLabel::tempat,
            'pengurusi' => GeneralLabel::pengurusi,
            'pencatat_minit' => GeneralLabel::pencatat_minit,
            'perkara_perkara_dan_tindakan' => GeneralLabel::perkara_perkara_dan_tindakan,
            'mesyuarat_tamat' => GeneralLabel::mesyuarat_tamat,
            'mesyuarat_seterusnya' => GeneralLabel::mesyuarat_seterusnya,
            'muat_naik' => GeneralLabel::muat_naik,
            'disedia_oleh' => GeneralLabel::disedia_oleh,
            'disemak_oleh' => GeneralLabel::disemak_oleh,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefTempatJkk(){
        return $this->hasOne(RefTempatJkk::className(), ['id' => 'tempat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefFasa(){
        return $this->hasOne(RefFasa::className(), ['id' => 'fasa']);
    }
}