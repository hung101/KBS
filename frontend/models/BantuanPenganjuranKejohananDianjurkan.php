<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_bantuan_penganjuran_kejohanan_dianjurkan".
 *
 * @property integer $bantuan_penganjuran_kejohanan_dianjurkan_id
 * @property integer $bantuan_penganjuran_kejohanan_id
 * @property string $kejohanan
 * @property string $tarikh_mula
 * @property string $tarikh_tamat
 * @property string $tempat
 * @property string $peringkat_penganjuran
 * @property string $jumlah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class BantuanPenganjuranKejohananDianjurkan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_bantuan_penganjuran_kejohanan_dianjurkan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_penganjuran_kejohanan_id', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['kejohanan', 'tarikh_mula', 'tarikh_tamat', 'tempat', 'peringkat_penganjuran', 'jumlah'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh_mula', 'tarikh_tamat', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [[ 'peringkat_penganjuran'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['peringkat_penganjuran_lain'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kejohanan','tempat'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tarikh_tamat'], 'compare', 'compareAttribute'=>'tarikh_mula', 'operator'=>'>=', 'message' => GeneralMessage::yii_validation_compare],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'bantuan_penganjuran_kejohanan_dianjurkan_id' => 'Bantuan Penganjuran Kejohanan Dianjurkan ID',
            'bantuan_penganjuran_kejohanan_id' => 'Bantuan Penganjuran Kejohanan ID',
            'kejohanan' => 'Kejohanan',
            'tarikh_mula' => 'Tarikh Mula',
            'tarikh_tamat' => 'Tarikh Tamat',
            'tempat' => 'Tempat',
            'peringkat_penganjuran' => 'Peringkat Penganjuran',
            'jumlah' => 'Jumlah (RM)',
            'peringkat_penganjuran_lain' => 'Nyatakan (Jika Lain-lain)',
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
    public function getRefPeringkatBantuanPenganjuranKejohananDianjurkan(){
        return $this->hasOne(RefPeringkatBantuanPenganjuranKejohananDianjurkan::className(), ['id' => 'peringkat_penganjuran']);
    }
}
