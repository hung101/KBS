<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_jurulatih_sukan".
 *
 * @property integer $jurulatih_sukan_id
 * @property integer $jurulatih_id
 * @property string $program
 * @property string $sukan
 * @property string $cawangan
 * @property string $bahagian
 * @property string $tarikh_mula_lantikan
 * @property string $tarikh_tamat_lantikan
 * @property string $gaji_elaun
 * @property string $jumlah
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class JurulatihSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_jurulatih_sukan';
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
            [['jurulatih_id', 'program', 'sukan', 'cawangan', 'bahagian', 'tarikh_mula_lantikan', 'tarikh_tamat_lantikan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['jurulatih_id', 'created_by', 'updated_by', 'gaji_dan_elaun_jurulatih_id', 'gaji_jurulatih_id', 'elaun_jurulatih_id', 'gaji_elaun'
                , 'bahagian'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh_mula_lantikan', 'tarikh_tamat_lantikan', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number', 'message' => GeneralMessage::yii_validation_number],
            [['program', 'sukan', 'cawangan'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'jurulatih_sukan_id' => GeneralLabel::jurulatih_sukan_id,
            'jurulatih_id' => GeneralLabel::jurulatih_id,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'cawangan' => GeneralLabel::cawangan,
            'bahagian' => GeneralLabel::bahagian,
            'tarikh_mula_lantikan' => GeneralLabel::tarikh_mula_lantikan,
            'tarikh_tamat_lantikan' => GeneralLabel::tarikh_tamat_lantikan,
            'gaji_elaun' => GeneralLabel::gaji_elaun,
            'jumlah' => GeneralLabel::jumlah,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramJurulatih(){
        return $this->hasOne(RefProgramJurulatih::className(), ['id' => 'program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefBahagianJurulatih(){
        return $this->hasOne(RefBahagianJurulatih::className(), ['id' => 'bahagian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefJurulatihAcara(){
        return $this->hasMany(JurulatihSukanAcara::className(), ['jurulatih_sukan_id' => 'jurulatih_sukan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefGajiElaunJurulatih(){
        return $this->hasOne(RefGajiElaunJurulatih::className(), ['id' => 'gaji_elaun']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefCawangan(){
        return $this->hasOne(RefCawangan::className(), ['id' => 'cawangan']);
    }
}
