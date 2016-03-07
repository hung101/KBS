<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_kehadiran_media_program".
 *
 * @property integer $pengurusan_kehadiran_media_program_id
 * @property integer $pengurusan_media_program_id
 * @property string $program
 * @property string $nama_wartawan
 * @property string $emel
 * @property string $agensi
 * @property string $no_telefon
 */
class PengurusanKehadiranMediaProgram extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_kehadiran_media_program';
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
            [['nama_wartawan'], 'required', 'skipOnEmpty' => true],
            [['pengurusan_media_program_id'], 'integer'],
            [['program', 'nama_wartawan', 'agensi'], 'string', 'max' => 80],
            [['emel'], 'string', 'max' => 100],
            [['no_telefon'], 'string', 'max' => 14]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_kehadiran_media_program_id' => 'Pengurusan Kehadiran Media Program ID',
            'pengurusan_media_program_id' => 'Pengurusan Media Program ID',
            'program' => 'Program',
            'nama_wartawan' => 'Nama Wartawan',
            'emel' => 'Emel',
            'agensi' => 'Agensi',
            'no_telefon' => 'No Telefon',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilWartawanSukan(){
        return $this->hasOne(ProfilWartawanSukan::className(), ['profil_wartawan_sukan_id' => 'nama_wartawan']);
    }
}
