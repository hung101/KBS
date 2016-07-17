<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pemberian_jus_pemulihan".
 *
 * @property integer $pemberian_jus_pemulihan_id
 * @property integer $perkhidmatan_permakanan_id
 * @property string $kategori_atlet
 * @property integer $sukan
 * @property integer $acara
 * @property string $atlet
 * @property string $nama_jus
 * @property integer $jenis_jus
 * @property integer $kuantiti
 * @property integer $berat_badan
 * @property string $buah
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PemberianJusPemulihan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pemberian_jus_pemulihan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['atlet', 'nama_jus', 'kuantiti'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['perkhidmatan_permakanan_id', 'sukan', 'acara', 'jenis_jus', 'kuantiti', 'berat_badan', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['created', 'updated', 'tarikh'], 'safe'],
            [['kategori_atlet', 'jantina'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['atlet', 'nama_jus', 'buah'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pemberian_jus_pemulihan_id' => 'Pemberian Jus Pemulihan ID',
            'perkhidmatan_permakanan_id' => 'Perkhidmatan Permakanan ID',
            'kategori_atlet' => GeneralLabel::kategori_atlet,
            'sukan' => GeneralLabel::sukan,
            'acara' => GeneralLabel::acara,
            'atlet' => GeneralLabel::atlet,
            'nama_jus' => GeneralLabel::nama_jus,
            'jenis_jus' => GeneralLabel::jenis_jus,
            'kuantiti' => GeneralLabel::kuantiti,
            'berat_badan' => GeneralLabel::berat_badan,
            'buah' => GeneralLabel::buah,
            'tarikh' => GeneralLabel::tarikh,
            'jantina' => GeneralLabel::jantina,
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
    public function getRefNamaJus(){
        return $this->hasOne(RefNamaJus::className(), ['id' => 'nama_jus']);
    }
}
