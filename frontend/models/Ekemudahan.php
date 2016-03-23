<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            [['kategori', 'jenis', 'lokasi', 'kadar_sewa', 'nama_perniagaan_perkhidmatan_organisasi', 'kapasiti_penggunaan', 'no_lesen_pendaftaran'], 'required', 'skipOnEmpty' => true],
            [['kadar_sewa'], 'number'],
            [['kategori', 'jenis', 'no_lesen_pendaftaran'], 'string', 'max' => 30],
            [['gambar', 'dihubungi', 'nama_perniagaan_perkhidmatan_organisasi'], 'string', 'max' => 100],
            [['lokasi'], 'string', 'max' => 90],
            [['url'], 'string', 'max' => 200],
            [['kapasiti_penggunaan'], 'string', 'max' => 50]
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
