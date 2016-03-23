<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_atlet_perubatan_sejarah".
 *
 * @property integer $sejarah_perubatan_id
 * @property integer $atlet_id
 * @property string $jenis
 * @property string $jenis_sejarah_perubatan
 * @property string $bila
 * @property string $mana
 * @property string $bagaimana
 * @property string $siapa_yang_merawat
 */
class AtletPerubatanSejarah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_perubatan_sejarah';
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
            [['atlet_id', 'jenis_sejarah_perubatan'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['bila'], 'safe'],
            [['jenis'], 'string', 'max' => 60],
            [['jenis_sejarah_perubatan'], 'string', 'max' => 20],
            [['mana'], 'string', 'max' => 90],
            [['bagaimana'], 'string', 'max' => 255],
            [['siapa_yang_merawat'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sejarah_perubatan_id' => GeneralLabel::sejarah_perubatan_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'jenis' => GeneralLabel::jenis,
            'jenis_sejarah_perubatan' => GeneralLabel::jenis_sejarah_perubatan,
            'bila' => GeneralLabel::bila,
            'mana' => GeneralLabel::mana,
            'bagaimana' => GeneralLabel::bagaimana,
            'siapa_yang_merawat' => GeneralLabel::siapa_yang_merawat,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisPenyakit(){
        return $this->hasOne(RefPenyakit::className(), ['id' => 'jenis']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJenisSejarahPerubatan(){
        return $this->hasOne(RefJenisSejarahPerubatan::className(), ['id' => 'jenis_sejarah_perubatan']);
    }
}
