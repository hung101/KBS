<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_pertukaran_pengajian".
 *
 * @property integer $pertukaran_pengajian_id
 * @property integer $atlet_id
 * @property string $sebab_pemohonan
 * @property string $kategori_pengajian
 * @property string $nama_pengajian_sekarang
 * @property string $nama_pertukaran_pengajian
 * @property string $sebab_pertukaran
 * @property string $sebab_penangguhan
 */
class PertukaranPengajian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pertukaran_pengajian';
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
            [['atlet_id', 'program', 'sukan', 'sebab_pemohonan'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id', 'status_permohonan'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh', 'tarikh_akhir', 'tarikh_permohonan'], 'safe'],
            [['sebab_pemohonan', 'sebab_pertukaran', 'sebab_penangguhan', 'sebab'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_pengajian', 'tempoh_penangguhan'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pengajian_sekarang', 'nama_pertukaran_pengajian', 'kejohanan_program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['program', 'sukan', 'sebab_pemohonan', 'sebab_pertukaran', 'sebab_penangguhan', 'sebab','kategori_pengajian', 'tempoh_penangguhan','tempat',
                'nama_pengajian_sekarang', 'nama_pertukaran_pengajian', 'kejohanan_program'], function ($attribute, $params) {
                if (!\common\models\general\GeneralFunction::validateXSS($this->$attribute)) {
                    $this->addError($attribute, GeneralMessage::yii_validation_xss);
                }
            }],
        ];
    }
    

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pertukaran_pengajian_id' => GeneralLabel::pertukaran_pengajian_id,
            'atlet_id' => GeneralLabel::atlet_id,
            'sebab_pemohonan' => GeneralLabel::jenis_permohonan,
            'kategori_pengajian' => GeneralLabel::falkuti_pengajian,
            'nama_pengajian_sekarang' => GeneralLabel::nama_pengajian_sekarang,
            'nama_pertukaran_pengajian' => GeneralLabel::nama_pertukaran_pengajian,
            'sebab_pertukaran' => GeneralLabel::sebab_pertukaran,
            'sebab_penangguhan' => GeneralLabel::sebab_penangguhan,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'kejohanan_program' => GeneralLabel::kejohanan_program,
            'tarikh' => 'Tarikh Mula Pelepasan',
            'tarikh_akhir' => 'Tarikh Akhir Pelepasan',
            'tempat' => GeneralLabel::tempat,
            'sebab' => GeneralLabel::no_matriks,
            'tempoh_penangguhan' => GeneralLabel::tempoh_penangguhan,
            'status_permohonan' => GeneralLabel::status_permohonan,
            'tarikh_permohonan' => GeneralLabel::tarikh_permohonan,
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefPengajian(){
        return $this->hasOne(RefPengajian::className(), ['id' => 'nama_pertukaran_pengajian']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSebabPermohonanPertukaranPengajian(){
        return $this->hasOne(RefSebabPermohonanPertukaranPengajian::className(), ['id' => 'sebab_pemohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusPermohonanPendidikan(){
        return $this->hasOne(RefStatusPermohonanPendidikan::className(), ['id' => 'status_permohonan']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgramSemasaSukanAtlet(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan']);
    }
}
