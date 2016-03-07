<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_forum_seminar_persidangan_di_luar_negara".
 *
 * @property integer $forum_seminar_persidangan_di_luar_negara_id
 * @property string $nama
 * @property string $amaun
 * @property string $negara
 * @property string $status_permohonan
 * @property string $catatan
 */
class ForumSeminarPersidanganDiLuarNegara extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_forum_seminar_persidangan_di_luar_negara';
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
            [['jenis_program','nama', 'nama_program', 'tarikh', 'persatuan', 'jawatan', 'nama_wakil_persatuan_1', 'nama_wakil_persatuan_2', 'amaun', 'negara', 'status_permohonan'], 'required', 'skipOnEmpty' => true],
            [['amaun'], 'number'],
            [['nama'], 'string', 'max' => 80],
            [['negara', 'status_permohonan'], 'string', 'max' => 30],
            [['catatan'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'forum_seminar_persidangan_di_luar_negara_id' => 'Forum Seminar Persidangan Di Luar Negara ID',
            'nama_pemohon' => 'Nama Pemohon',
            'jawatan_pemohon' => 'Jawatan Pemohon',
            'persatuan_pemohon' => 'Persatuan Pemohon',
            'jenis_program' => 'Jenis Program',
            'nama' => 'Nama Pemohon',
            'nama_program' => 'Nama Program',
            'tarikh' => 'Tarikh',
            'persatuan' => 'Persatuan',
            'jawatan' => 'Jawatan',
            'nama_wakil_persatuan_1' => 'Nama Wakil Persatuan 1',
            'nama_wakil_persatuan_2' => 'Nama Wakil Persatuan 2',
            'amaun' => 'Amaun',
            'negara' => 'Negara',
            'status_permohonan' => 'Status Permohonan',
            'catatan' => 'Catatan',
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
    public function getRefStatusPermohonanBantuanMenghadiriProgramAntarabangs(){
        return $this->hasOne(RefStatusPermohonanBantuanMenghadiriProgramAntarabangs::className(), ['id' => 'status_permohonan']);
    }
}
