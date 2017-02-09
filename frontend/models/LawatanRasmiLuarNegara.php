<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_lawatan_rasmi_luar_negara".
 *
 * @property integer $lawatan_rasmi_luar_negara_id
 * @property string $lawatan
 * @property string $negara
 * @property string $tarikh
 * @property string $delegasi
 * @property integer $jumlah_delegasi
 * @property string $nama_pegawai_terlibat
 * @property string $catatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LawatanRasmiLuarNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_lawatan_rasmi_luar_negara';
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
            [['lawatan', 'negara', 'tarikh', 'delegasi', 'jumlah_delegasi'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['delegasi', 'nama_pegawai_terlibat', 'catatan'], 'string'],
            [['jumlah_delegasi', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['lawatan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['negara'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'lawatan_rasmi_luar_negara_id' => 'Lawatan Rasmi Luar Negara ID',
            'lawatan' => GeneralLabel::lawatan,  //'Lawatan',
            'negara' => GeneralLabel::negara,  //'Negara',
            'tarikh' => GeneralLabel::tarikh,  //'Tarikh',
            'delegasi' => GeneralLabel::delegasi,  //'Delegasi',
            'jumlah_delegasi' => GeneralLabel::jumlah_delegasi,  //'Jumlah Delegasi',
            'nama_pegawai_terlibat' => GeneralLabel::nama_pegawai_terlibat,  //'Nama Pegawai Terlibat',
            'catatan' => GeneralLabel::catatan,  //'Catatan',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegara(){
        return $this->hasOne(RefNegara::className(), ['id' => 'negara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefLawatan(){
        return $this->hasOne(RefLawatan::className(), ['id' => 'lawatan']);
    }
}
