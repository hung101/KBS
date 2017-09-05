<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_kpi".
 *
 * @property integer $pengurusan_kpi_id
 * @property string $nama_sukan
 * @property string $nama_acara
 * @property integer $jumlah_sasaran_pingat
 * @property integer $jumlah_pingat_yang_telah_dimenangi
 * @property string $rekod_baru_yang_dicipta
 * @property string $senarai_atlet_yang_memenangi
 */
class PengurusanKpi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kpi';
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
            [['nama_sukan', 'nama_acara', 'jumlah_sasaran_pingat', 'jumlah_pingat_yang_telah_dimenangi', 'rekod_baru_yang_dicipta', 'senarai_atlet_yang_memenangi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jumlah_sasaran_pingat', 'jumlah_pingat_yang_telah_dimenangi'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['senarai_atlet_yang_memenangi'], 'safe'],
            [['nama_sukan', 'nama_acara', 'rekod_baru_yang_dicipta'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            //[['senarai_atlet_yang_memenangi'], 'string', 'max' => 255],
            [['nama_sukan', 'nama_acara', 'rekod_baru_yang_dicipta'], function ($attribute, $params) {
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
            'pengurusan_kpi_id' => GeneralLabel::pengurusan_kpi_id,
            'nama_sukan' => GeneralLabel::nama_sukan,
            'nama_acara' => GeneralLabel::nama_acara,
            'jumlah_sasaran_pingat' => GeneralLabel::jumlah_sasaran_pingat,
            'jumlah_pingat_yang_telah_dimenangi' => GeneralLabel::jumlah_pingat_yang_telah_dimenangi,
            'rekod_baru_yang_dicipta' => GeneralLabel::rekod_baru_yang_dicipta,
            'senarai_atlet_yang_memenangi' => GeneralLabel::senarai_atlet_yang_memenangi,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'nama_acara']);
    }
}
