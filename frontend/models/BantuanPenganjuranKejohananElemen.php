<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_elemen".
 *
 * @property integer $bantuan_penganjuran_kejohanan_elemen_id
 * @property integer $bantuan_penganjuran_kejohanan_id
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
class BantuanPenganjuranKejohananElemen extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_elemen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'bilangan', 'hari', 'created_by', 'updated_by'], 'integer'],
            [['elemen_bantuan', 'sub_elemen', 'kadar', 'bilangan', 'hari', 'jumlah'], 'required'],
            [['kadar', 'jumlah'], 'number'],
            [['created', 'updated'], 'safe'],
            [['elemen_bantuan', 'sub_elemen'], 'string', 'max' => 30],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_elemen_id' => 'Bantuan Penganjuran Kejohanan Elemen ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'elemen_bantuan' => 'Elemen Bantuan',
            'sub_elemen' => 'Sub-Elemen',
            'kadar' => 'Kadar (RM)',
            'bilangan' => 'Bilangan',
            'hari' => 'Hari',
            'jumlah' => 'Jumlah (RM)',
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
