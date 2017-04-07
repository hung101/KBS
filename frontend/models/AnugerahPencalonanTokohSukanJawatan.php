<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_lain_jawatan".
 *
 * @property integer $anugerah_pencalonan_lain_jawatan_id
 * @property integer $anugerah_pencalonan_lain_id
 * @property string $jawatan
 * @property string $nama_persatuan_pertubuhan
 * @property string $tempoh
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanTokohSukanJawatan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_tokoh_sukan_jawatan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_lain_id', 'created_by', 'updated_by'], 'integer', 'skipOnEmpty' => true],
            [['jawatan', 'nama_persatuan_pertubuhan', 'tempoh'], 'required'],
            [['tempoh', 'created', 'updated'], 'safe'],
            [['jawatan'], 'string', 'max' => 80],
            [['nama_persatuan_pertubuhan', 'session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_lain_jawatan_id' => 'Anugerah Pencalonan Lain Jawatan ID',
            'anugerah_pencalonan_lain_id' => 'Anugerah Pencalonan Lain ID',
            'jawatan' => GeneralLabel::jawatan,  //'Jawatan',
            'nama_persatuan_pertubuhan' => GeneralLabel::nama_persatuan,  //'Nama Persatuan/Pertubuhan',
            'tempoh' => GeneralLabel::tempoh_tahun,  //'Tempoh (Tahun)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
