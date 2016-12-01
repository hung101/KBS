<?php

namespace app\models;

use Yii;


use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pengurusan_jawatankuasa_khas_sukan_malaysia_ahli".
 *
 * @property integer $pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id
 * @property string $jenis_keahlian
 * @property string $jenis_keahlian_nyatakan
 * @property string $nama
 * @property integer $jawatan
 * @property integer $agensi_organisasi
 * @property string $agensi_organisasi_nyatakan
 * @property integer $negeri
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanJawatankuasaKhasSukanMalaysiaAhli extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_jawatankuasa_khas_sukan_malaysia_ahli';
    }
    
    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
            [
                'class' => \yii\behaviors\BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
            [
                'class' => \yii\behaviors\TimestampBehavior::className(),
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => 'updated',
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_keahlian', 'nama', 'jawatan', 'agensi_organisasi', 'jawatankuasa'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['nama', 'created', 'updated'], 'safe'],
            [['jawatan', 'agensi_organisasi', 'negeri', 'created_by', 'updated_by', 'jawatankuasa'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['jenis_keahlian'], 'string', 'max' => 11],
            [['jenis_keahlian_nyatakan', 'agensi_organisasi_nyatakan', 'jawatan_lain_lain'], 'string', 'max' => 80],
            [['session_id', 'emel'], 'string', 'max' => 100],
            [['emel'], 'email', 'message' => GeneralMessage::yii_validation_email],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id' => 'Pengurusan Jawatankuasa Khas Sukan Malaysia Ahli ID',
            'jenis_keahlian' => GeneralLabel::jenis_keahlian, //'Jenis Keahlian',
            'jenis_keahlian_nyatakan' => GeneralLabel::jenis_keahlian_nyatakan, //'Nyatakan Jenis Keahlian (Jika Lain-lain)',
            'nama' => GeneralLabel::nama, //'Nama',
            'jawatan' => GeneralLabel::jawatan, //'Jawatan',
            'agensi_organisasi' => GeneralLabel::agensi_organisasi, //'Agensi / Organisasi',
            'agensi_organisasi_nyatakan' => GeneralLabel::agensi_organisasi_nyatakan, //'Nyatakan Agensi / Organisasi (Jika Lain-lain)',
            'negeri' => GeneralLabel::negeri, //'Negeri',
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'jawatan_lain_lain' => GeneralLabel::jawatan_lain_lain, //'Nyatakan Jawatan (Jika Lain-lain)',
            'jawatankuasa' => GeneralLabel::jawatankuasa, //'Jawatankuasa',
            'emel' => GeneralLabel::emel, //'Emel',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJenisKeahlian(){
        return $this->hasOne(RefJenisKeahlian::className(), ['id' => 'jenis_keahlian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatanJawatankuasaKhas(){
        return $this->hasOne(RefJawatanJawatankuasaKhas::className(), ['id' => 'jawatan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJawatankuasaKhas(){
        return $this->hasOne(RefJawatankuasaKhas::className(), ['id' => 'jawatankuasa']);
    }
}
