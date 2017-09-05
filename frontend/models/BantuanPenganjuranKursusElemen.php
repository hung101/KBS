<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_elemen".
 *
 * @property integer $bantuan_penganjuran_kejohanan_elemen_id
 * @property integer $bantuan_penganjuran_kursus_id
 * @property string $elemen_bantuan
 * @property string $sub_elemen
 * @property string $kadar
 * @property integer $bilangan
 * @property integer $hari
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKursusElemen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kursus_elemen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kursus_id', 'bilangan', 'hari', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['elemen_bantuan', 'sub_elemen', 'kadar', 'bilangan', 'hari', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['kadar', 'jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['created', 'updated'], 'safe'],
            [['elemen_bantuan', 'sub_elemen'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['elemen_bantuan', 'sub_elemen'], function ($attribute, $params) {
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
            'bantuan_penganjuran_kejohanan_elemen_id' => 'Bantuan Penganjuran Kejohanan Elemen ID',
            'bantuan_penganjuran_kursus_id' => 'Bantuan Penganjuran Kejohanan ID',
            'elemen_bantuan' => GeneralLabel::elemen_bantuan,  //'Elemen Bantuan',
            'sub_elemen' => GeneralLabel::sub_elemen,  //'Sub-Elemen',
            'kadar' => GeneralLabel::kadar,  //'Kadar (RM)',
            'bilangan' => GeneralLabel::bilangan,  //'Bilangan',
            'hari' => GeneralLabel::hari,  //'Hari',
            'jumlah' => GeneralLabel::jumlah,  //'Jumlah (RM)',
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
    public function getRefElemenBantuanPenganjuranKejohanan(){
        return $this->hasOne(RefElemenBantuanPenganjuranKejohanan::className(), ['id' => 'elemen_bantuan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubElemenBantuanPenganjuranKejohanan(){
        return $this->hasOne(RefSubElemenBantuanPenganjuranKejohanan::className(), ['id' => 'sub_elemen']);
    }
}
