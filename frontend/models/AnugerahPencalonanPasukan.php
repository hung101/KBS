<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_pasukan".
 *
 * @property integer $anugerah_pencalonan_pasukan_id
 * @property string $kategori
 * @property string $sukan
 * @property string $nama_pasukan
 * @property string $gambar_pasukan
 * @property string $ulasan_pencapaian
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanPasukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_pasukan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kategori', 'sukan', 'nama_pasukan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['kategori', 'sukan'], 'string', 'max' => 30],
            [['nama_pasukan'], 'string', 'max' => 80],
            [['gambar_pasukan'], 'string', 'max' => 100],
            [['ulasan_pencapaian'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_pasukan_id' => 'Anugerah Pencalonan Pasukan ID',
            'kategori' => 'Kategori',
            'sukan' => 'Sukan',
            'nama_pasukan' => 'Nama Pasukan',
            'gambar_pasukan' => 'Gambar Pasukan',
            'ulasan_pencapaian' => 'Ulasan Pencapaian',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
