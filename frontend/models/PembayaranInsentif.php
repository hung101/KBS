<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pembayaran_insentif".
 *
 * @property integer $pembayaran_insentif_id
 * @property string $kejohanan
 * @property integer $jenis_insentif
 * @property integer $pingat
 * @property integer $kumpulan_temasya_kejohanan
 * @property integer $rekod_baharu
 * @property string $jumlah
 * @property string $kelulusan
 * @property string $tarikh_kelulusan
 * @property string $tarikh_pembayaran_insentif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PembayaranInsentif extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pembayaran_insentif';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_insentif', 'pingat', 'kumpulan_temasya_kejohanan', 'rekod_baharu', 'kejohanan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jenis_insentif', 'pingat', 'kumpulan_temasya_kejohanan', 'rekod_baharu', 'created_by', 'updated_by'], 'integer'],
            [['jumlah'], 'number'],
            [['tarikh_kelulusan', 'tarikh_pembayaran_insentif', 'created', 'updated'], 'safe'],
            [['kejohanan'], 'string', 'max' => 100],
            [['kelulusan'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pembayaran_insentif_id' => 'Pembayaran Insentif ID',
            'kejohanan' => GeneralLabel::kejohanan,
            'jenis_insentif' => GeneralLabel::jenis_insentif,
            'pingat' => GeneralLabel::pingat,
            'kumpulan_temasya_kejohanan' => GeneralLabel::kumpulan_temasya_kejohanan,
            'rekod_baharu' => GeneralLabel::rekod_baharu,
            'jumlah' => GeneralLabel::jumlah,
            'kelulusan' => GeneralLabel::kelulusan,
            'tarikh_kelulusan' => GeneralLabel::tarikh_kelulusan,
            'tarikh_pembayaran_insentif' => GeneralLabel::tarikh_pembayaran_insentif,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisInsentif(){
        return $this->hasOne(RefJenisInsentif::className(), ['id' => 'jenis_insentif']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPingatInsentif(){
        return $this->hasOne(RefPingatInsentif::className(), ['id' => 'pingat']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengurusanInsentifTetapanShakamShakar(){
        return $this->hasOne(PengurusanInsentifTetapanShakamShakar::className(), ['pengurusan_insentif_tetapan_shakam_shakar_id' => 'kumpulan_temasya_kejohanan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKelulusan(){
        return $this->hasOne(RefKelulusan::className(), ['id' => 'kelulusan']);
    }
}