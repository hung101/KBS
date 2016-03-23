<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

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
            'forum_seminar_persidangan_di_luar_negara_id' => GeneralLabel::forum_seminar_persidangan_di_luar_negara_id,
            'nama_pemohon' => GeneralLabel::nama_pemohon,
            'jawatan_pemohon' => GeneralLabel::jawatan_pemohon,
            'persatuan_pemohon' => GeneralLabel::persatuan_pemohon,
            'jenis_program' => GeneralLabel::jenis_program,
            'nama' => GeneralLabel::nama,
            'nama_program' => GeneralLabel::nama_program,
            'tarikh' => GeneralLabel::tarikh,
            'persatuan' => GeneralLabel::persatuan,
            'jawatan' => GeneralLabel::jawatan,
            'nama_wakil_persatuan_1' => GeneralLabel::nama_wakil_persatuan_1,
            'nama_wakil_persatuan_2' => GeneralLabel::nama_wakil_persatuan_2,
            'amaun' => GeneralLabel::amaun,
            'negara' => GeneralLabel::negara,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'catatan' => GeneralLabel::catatan,

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
