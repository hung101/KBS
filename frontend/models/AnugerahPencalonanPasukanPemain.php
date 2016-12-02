<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_anugerah_pencalonan_pasukan_pemain".
 *
 * @property integer $anugerah_pencalonan_pasukan_pemain_id
 * @property integer $anugerah_pencalonan_pasukan_id
 * @property string $nama_pemain
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AnugerahPencalonanPasukanPemain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_anugerah_pencalonan_pasukan_pemain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_pemain'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['anugerah_pencalonan_pasukan_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['nama_pemain'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'anugerah_pencalonan_pasukan_pemain_id' => 'Anugerah Pencalonan Pasukan Pemain ID',
            'anugerah_pencalonan_pasukan_id' => 'Anugerah Pencalonan Pasukan ID',
            'nama_pemain' => GeneralLabel::nama_pemain,  //'Nama Pemain',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'nama_pemain']);
    }
}
