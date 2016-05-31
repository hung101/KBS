<?php

namespace app\models;

use Yii;
use app\models\general\GeneralMessage;
use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_pengurusan_permohonan_kursus_persatuan_penasihat".
 *
 * @property integer $pengurusan_permohonan_kursus_persatuan_penasihat_id
 * @property integer $pengurusan_permohonan_kursus_persatuan_id
 * @property integer $nama
 * @property string $tarikh_mula_bertugas
 * @property string $tarikh_tamat_bertugas
 * @property integer $silibus
 * @property string $catatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class PengurusanPermohonanKursusPersatuanPenasihat extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_permohonan_kursus_persatuan_penasihat';
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
            [['nama', 'silibus', 'tarikh_mula_bertugas', 'tarikh_tamat_bertugas'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['pengurusan_permohonan_kursus_persatuan_id', 'nama', 'silibus', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_mula_bertugas', 'tarikh_tamat_bertugas', 'created', 'updated'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_permohonan_kursus_persatuan_penasihat_id' => 'Pengurusan Permohonan Kursus Persatuan Penasihat ID',
            'pengurusan_permohonan_kursus_persatuan_id' => 'Pengurusan Permohonan Kursus Persatuan ID',
            'nama' => GeneralLabel::nama,
            'tarikh_mula_bertugas' => GeneralLabel::tarikh_mula_bertugas,
            'tarikh_tamat_bertugas' => GeneralLabel::tarikh_tamat_bertugas,
            'silibus' => GeneralLabel::silibus,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProfilPanelPenasihatKpsk(){
        return $this->hasOne(ProfilPanelPenasihatKpsk::className(), ['profil_panel_penasihat_kpsk_id' => 'nama']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSilibus(){
        return $this->hasOne(RefSilibus::className(), ['id' => 'silibus']);
    }
}
