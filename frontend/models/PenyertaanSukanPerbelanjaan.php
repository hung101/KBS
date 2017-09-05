<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use app\models\RefKategoriPerbelanjaanSukan;

/**
 * This is the model class for table "tbl_penyertaan_sukan_perbelanjaan".
 */
class PenyertaanSukanPerbelanjaan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penyertaan_sukan_perbelanjaan';
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
            [['kategori_perbelanjaan', 'jumlah_pohon', 'jumlah_cadang', 'jumlah_lulus'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['penyertaan_sukan_id', 'kategori_perbelanjaan', 'orang_pohon', 'orang_cadang', 'orang_lulus', 'hari_pohon', 'hari_cadang', 'hari_lulus'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['harga_pohon', 'harga_cadang', 'harga_lulus', 'jumlah_pohon', 'jumlah_cadang', 'jumlah_lulus'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan_pohon', 'catatan_cadang', 'catatan_lulus', 'perkara'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['catatan_pohon', 'catatan_cadang', 'catatan_lulus', 'perkara'], function ($attribute, $params) {
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
            'penyertaan_sukan_perbelanjaan_id' => GeneralLabel::penyertaan_sukan_perbelanjaan_id,
            'penyertaan_sukan_id' => GeneralLabel::penyertaan_sukan_id,
            'kategori_perbelanjaan' => GeneralLabel::kategori,
            'harga_pohon' => GeneralLabel::harga,
            'harga_cadang' => GeneralLabel::harga,
            'harga_lulus' => GeneralLabel::harga,
            'orang_pohon' => GeneralLabel::orang,
            'orang_cadang' => GeneralLabel::orang,
            'orang_lulus' => GeneralLabel::orang,
            'hari_pohon' => GeneralLabel::hari,
            'hari_cadang' => GeneralLabel::hari,
            'hari_lulus' => GeneralLabel::hari,
            'catatan_pohon' => GeneralLabel::catatan,
            'catatan_cadang' => GeneralLabel::catatan,
            'catatan_lulus' => GeneralLabel::catatan,
            'jumlah_pohon' => GeneralLabel::jumlah,
            'jumlah_cadang' => GeneralLabel::jumlah,
            'jumlah_lulus' => GeneralLabel::jumlah,
			'perkara' => GeneralLabel::perkara,
        ];
    }
    
    public function getRefKategoriPerbelanjaanSukan(){
        return $this->hasOne(RefKategoriPerbelanjaanSukan::className(), ['id' => 'kategori_perbelanjaan']);
    }
}
