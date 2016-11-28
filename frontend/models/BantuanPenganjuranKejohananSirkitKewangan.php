<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_kewangan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_kewangan_id
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $sumber_kewangan
 * @property string $lain_lain
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananSirkitKewangan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_sirkit_kewangan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'created_by', 'updated_by'], 'integer'],
            [['sumber_kewangan', 'jumlah'], 'required'],
            [['jumlah'], 'number'],
            [['created', 'updated'], 'safe'],
            [['sumber_kewangan'], 'string', 'max' => 30],
            [['lain_lain'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_kewangan_id' => 'Bantuan Penganjuran Kejohanan Kewangan ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'sumber_kewangan' => GeneralLabel::sumber_kewangan,
            'lain_lain' => GeneralLabel::nyatakan_jika_lain_lain, //'Nyatakan (Jika Lain-lain)',
            'jumlah' => GeneralLabel::jumlah, //'Jumlah (RM)',
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
    public function getRefSumberKewanganBantuanPenganjuranKejohanan(){
        return $this->hasOne(RefSumberKewanganBantuanPenganjuranKejohanan::className(), ['id' => 'sumber_kewangan']);
    }
}
