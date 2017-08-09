<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_bayaran".
 *
 * @property integer $bantuan_penganjuran_kejohanan_bayaran_id
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $jenis_bayaran
 * @property string $lain_lain
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananSirkitBayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_sirkit_bayaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'created_by', 'updated_by'], 'integer'],
            [['jenis_bayaran', 'jumlah'], 'required'],
            [['jumlah'], 'number'],
            [['created', 'updated'], 'safe'],
            [['jenis_bayaran'], 'string', 'max' => 30],
            [['lain_lain'], 'string', 'max' => 80],
            [['session_id'], 'string', 'max' => 100],
            [['lain_lain','jenis_bayaran'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_bayaran_id' => 'Bantuan Penganjuran Kejohanan Bayaran ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'jenis_bayaran' => GeneralLabel::jenis_bayaran,
            'lain_lain' => GeneralLabel::nyatakan_jika_lain_lain,
            'jumlah' => GeneralLabel::jumlah,
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
    public function getRefJenisBayaranBantuanPenganjuranKejohanan(){
        return $this->hasOne(RefJenisBayaranBantuanPenganjuranKejohanan::className(), ['id' => 'jenis_bayaran']);
    }
}
