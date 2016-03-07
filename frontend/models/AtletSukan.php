<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_atlet_sukan".
 *
 * @property integer $sukan_id
 * @property integer $atlet_id
 * @property string $nama_sukan
 * @property string $acara
 * @property string $tahun_umur_permulaan
 * @property string $tarikh_mula_menyertai_program_msn
 * @property string $program_semasa
 * @property string $no_lesen_sukan
 * @property string $atlet_persekutuan_dunia_id
 */
class AtletSukan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_atlet_sukan';
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
            [['atlet_id', 'jurulatih_id', 'nama_sukan', 'acara'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['tahun_umur_permulaan', 'tarikh_mula_menyertai_program_msn', 'cawangan', 'negeri_diwakili', 'status', 'tarikh_tamat_menyertai_program_msn'], 'safe'],
            [['nama_sukan', 'acara', 'program_semasa'], 'string', 'max' => 100],
            [['no_lesen_sukan', 'atlet_persekutuan_dunia_id'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sukan_id' => 'Sukan ID',
            'atlet_id' => 'Atlet ID',
            'jurulatih_id' => 'Jurulatih',
            'nama_sukan' => 'Sukan',
            'acara' => 'Acara',
            'tahun_umur_permulaan' => 'Umur Mula Menceburi Sukan',
            'tarikh_mula_menyertai_program_msn' => 'Tarikh Mula Menyertai Program MSN',
            'tarikh_tamat_menyertai_program_msn' => 'Tarikh Tamat Menyertai Program MSN',
            'cawangan' => 'Cawangan',
            'program_semasa' => 'Program Semasa',
            'no_lesen_sukan' => 'No Lesen Sukan',
            'atlet_persekutuan_dunia_id' => 'ID Atlet Persekutuan Dunia',
            'negeri_diwakili' => 'Negeri Diwakili',
            'status' => 'Status'
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'nama_sukan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAcara(){
        return $this->hasOne(RefAcara::className(), ['id' => 'acara']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program_semasa']);
    }
}
