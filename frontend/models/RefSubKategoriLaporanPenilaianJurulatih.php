<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ref_sub_kategori_laporan_penilaian_jurulatih".
 *
 * @property integer $id
 * @property integer $ref_kategori_laporan_penilaian_jurulatih_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefSubKategoriLaporanPenilaianJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ref_sub_kategori_laporan_penilaian_jurulatih';
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
            [['ref_kategori_laporan_penilaian_jurulatih_id', 'aktif', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['desc'], 'required', 'message' => GeneralMessage::yii_validation_required],
            [['desc'], 'string', 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['created', 'updated'], 'safe'],
            [['desc'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ref_kategori_laporan_penilaian_jurulatih_id' => GeneralLabel::kategori_laporan_penilaian_jurulatih,
            'id' => GeneralLabel::id,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }
	
	/**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriLaporanPenilaianJurulatih(){
        return $this->hasOne(RefKategoriLaporanPenilaianJurulatih::className(), ['id' => 'ref_kategori_laporan_penilaian_jurulatih_id']);
    }
}
