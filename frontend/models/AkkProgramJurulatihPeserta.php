<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_akk_program_jurulatih_peserta".
 *
 * @property integer $akk_program_jurulatih_peserta_id
 * @property integer $akk_program_jurulatih_id
 * @property integer $jurulatih
 * @property integer $sukan
 * @property integer $acara
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class AkkProgramJurulatihPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_akk_program_jurulatih_peserta';
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
            [['akk_program_jurulatih_id', 'jurulatih', 'sukan', 'acara', 'created_by', 'updated_by', 'program', 'status_jurulatih'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'akk_program_jurulatih_peserta_id' => 'Akk Program Jurulatih Peserta ID',
            'akk_program_jurulatih_id' => 'Akk Program Jurulatih ID',
            'jurulatih' => 'Jurulatih',
            'sukan' => 'Sukan',
            'acara' => 'Acara',
            'program' => 'Program',
            'status_jurulatih' => 'Status Jurulatih',
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
    public function getRefJurulatih(){
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih']);
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
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
}
