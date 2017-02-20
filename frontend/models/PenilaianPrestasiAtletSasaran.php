<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_penilaian_prestasi_atlet_sasaran".
 *
 * @property integer $penilaian_prestasi_atlet_sasaran_id
 * @property integer $penilaian_pestasi_id
 * @property integer $atlet
 * @property string $sasaran
 * @property integer $keputusan
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PenilaianPrestasiAtletSasaran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_penilaian_prestasi_atlet_sasaran';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_pestasi_id', 'atlet', 'keputusan', 'created_by', 'updated_by'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['atlet', 'sasaran'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['created', 'updated'], 'safe'],
            [['sasaran'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['session_id'], 'string', 'max' => 100, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['rekod_baru', 'catatan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'penilaian_prestasi_atlet_sasaran_id' => 'Penilaian Prestasi Atlet Sasaran ID',
            'penilaian_pestasi_id' => GeneralLabel::penilaian_pestasi_id,
            'atlet' => GeneralLabel::atlet,
            'sasaran' => GeneralLabel::sasaran,
            'keputusan' => GeneralLabel::keputusan,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
            'rekod_baru' => GeneralLabel::rekod_baru,
            'catatan' => GeneralLabel::catatan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKeputusan(){
        return $this->hasOne(RefKeputusan::className(), ['id' => 'keputusan']);
    }
}
