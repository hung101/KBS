<?php

namespace app\models;

use Yii;

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
class BantuanPenganjuranKejohananBayaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_bayaran';
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
            'jenis_bayaran' => 'Jenis Bayaran',
            'lain_lain' => 'Nyatakan (Jika Lain-lain)',
            'jumlah' => 'Jumlah (RM)',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
