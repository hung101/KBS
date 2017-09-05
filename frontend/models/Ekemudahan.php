<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_ekemudahan".
 *
 * @property integer $ekemudahan_id
 * @property string $kategori
 * @property string $jenis
 * @property string $gambar
 * @property string $lokasi
 * @property string $dihubungi
 * @property string $kadar_sewa
 * @property string $url
 * @property string $nama_perniagaan_perkhidmatan_organisasi
 * @property string $kapasiti_penggunaan
 * @property string $no_lesen_pendaftaran
 */
class Ekemudahan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_ekemudahan';
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
            [['kategori', 'jenis', 'lokasi', 'kadar_sewa', 'nama_perniagaan_perkhidmatan_organisasi', 'kapasiti_penggunaan', 'no_lesen_pendaftaran'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['kadar_sewa'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['kategori', 'jenis', 'no_lesen_pendaftaran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['gambar', 'dihubungi', 'nama_perniagaan_perkhidmatan_organisasi'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['lokasi'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['url'], 'string', 'max' => 200, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kapasiti_penggunaan'], 'string', 'max' => 50, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori', 'jenis', 'no_lesen_pendaftaran','gambar', 'dihubungi', 'nama_perniagaan_perkhidmatan_organisasi','lokasi','url','kapasiti_penggunaan'], function ($attribute, $params) {
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
            'ekemudahan_id' => GeneralLabel::ekemudahan_id,
            'kategori' => GeneralLabel::kategori,
            'jenis' => GeneralLabel::jenis,
            'gambar' => GeneralLabel::gambar,
            'lokasi' => GeneralLabel::lokasi,
            'dihubungi' => GeneralLabel::dihubungi,
            'kadar_sewa' => GeneralLabel::kadar_sewa,
            'url' => GeneralLabel::url,
            'nama_perniagaan_perkhidmatan_organisasi' => GeneralLabel::nama_perniagaan_perkhidmatan_organisasi,
            'kapasiti_penggunaan' => GeneralLabel::kapasiti_penggunaan,
            'no_lesen_pendaftaran' => GeneralLabel::no_lesen_pendaftaran,

        ];
    }
}
