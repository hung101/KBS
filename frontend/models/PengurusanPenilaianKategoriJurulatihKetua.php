<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_penilaian_kategori_jurulatih".
 *
 * @property integer $pengurusan_penilaian_kategori_jurulatih_id
 * @property integer $pengurusan_pemantauan_dan_penilaian_jurulatih_id
 * @property string $penilaian_kategori
 * @property string $penilaian_sub_kategori
 * @property integer $markah_penilaian
 */
class PengurusanPenilaianKategoriJurulatihKetua extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_penilaian_kategori_jurulatih_ketua';
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
            [['penilaian_kategori', 'markah_penilaian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'markah_penilaian'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['penilaian_kategori', 'penilaian_sub_kategori'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'penilaian_kategori', 'penilaian_sub_kategori', 'session_id'], 'unique', 'targetAttribute' => ['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'penilaian_kategori', 'penilaian_sub_kategori', 'session_id'] , 'message' => GeneralMessage::yii_validation_unique_multiple],
            [['penilaian_kategori', 'penilaian_sub_kategori'], function ($attribute, $params) {
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
            'pengurusan_penilaian_kategori_jurulatih_id' => GeneralLabel::pengurusan_penilaian_kategori_jurulatih_id,
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => GeneralLabel::pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'penilaian_kategori' => GeneralLabel::penilaian_kategori,
            'penilaian_sub_kategori' => GeneralLabel::penilaian_sub_kategori,
            'markah_penilaian' => GeneralLabel::markah_penilaian,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriPenilaianJurulatih(){
        return $this->hasOne(RefKategoriPenilaianJurulatihKetua::className(), ['id' => 'penilaian_kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubKategoriPenilaianJurulatih(){
        return $this->hasOne(RefSubKategoriPenilaianJurulatihKetua::className(), ['id' => 'penilaian_sub_kategori']);
    }
}
