<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_jawatankuasa_khas_sukan_malaysia_ahli".
 *
 * @property integer $pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id
 * @property string $jenis_keahlian
 * @property string $jenis_keahlian_nyatakan
 * @property string $nama
 * @property integer $jawatan
 * @property integer $agensi_organisasi
 * @property string $agensi_organisasi_nyatakan
 * @property integer $negeri
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanJawatankuasaKhasSukanMalaysiaAhli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jawatankuasa_khas_sukan_malaysia_ahli';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'created', 'updated'], 'safe'],
            [['jawatan', 'agensi_organisasi', 'negeri', 'created_by', 'updated_by'], 'integer'],
            [['jenis_keahlian'], 'string', 'max' => 11],
            [['jenis_keahlian_nyatakan', 'agensi_organisasi_nyatakan'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia Ahli ID',
            'jenis_keahlian' => 'Jenis Keahlian',
            'jenis_keahlian_nyatakan' => 'Jenis Keahlian Nyatakan',
            'nama' => 'Nama',
            'jawatan' => 'Jawatan',
            'agensi_organisasi' => 'Agensi Organisasi',
            'agensi_organisasi_nyatakan' => 'Agensi Organisasi Nyatakan',
            'negeri' => 'Negeri',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
