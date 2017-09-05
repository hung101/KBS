<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_atlet_pencapaian_anugerah".
 *
 * @property integer $anugerah_id
 * @property integer $atlet_id
 * @property string $tahun
 * @property string $nama_acara
 * @property string $kategori
 * @property integer $insentif_id
 */
class AtletPencapaianAnugerah extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_pencapaian_anugerah';
    }
    
    public function behaviors()
    {
        return [
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
            [['atlet_id', 'tahun', 'nama_anugerah_pingat'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['sukan'], 'safe'],
            [['atlet_id', 'insentif_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tahun'], 'string', 'max' => 4, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_acara'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['remark'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_anugerah_pingat'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_acara','remark','kategori','nama_anugerah_pingat'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_id' => GeneralLabel::anugerah_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'tahun' => GeneralLabel::tahun,
            'nama_acara' => GeneralLabel::nama_acara,
            'sukan' => GeneralLabel::sukan,
            'kategori' => GeneralLabel::kategori,
            'remark' => GeneralLabel::remark,
            'insentif_id' => GeneralLabel::insentif_id,
            'nama_anugerah_pingat' => GeneralLabel::nama_anugerah_pingat,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriAnugerah(){
        return $this->hasOne(RefKategoriAnugerah::className(), ['id' => 'kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
