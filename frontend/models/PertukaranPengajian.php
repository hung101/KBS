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
            [['atlet_id', 'program', 'sukan', 'sebab_pemohonan', 'kategori_pengajian', 'nama_pengajian_sekarang', 'nama_pertukaran_pengajian'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['atlet_id'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['tarikh'], 'safe'],
            [['sebab_pemohonan', 'sebab_pertukaran', 'sebab_penangguhan'], 'string', 'max' => 255, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['kategori_pengajian'], 'string', 'max' => 30, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['tempat'], 'string', 'max' => 90, 'tooLong' => GeneralMessage::yii_validation_string_max],
            [['nama_pengajian_sekarang', 'nama_pertukaran_pengajian', 'kejohanan_program'], 'string', 'max' => 80, 'tooLong' => GeneralMessage::yii_validation_string_max]
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
            'sebab_pemohonan' => GeneralLabel::sebab_pemohonan,
            'kategori_pengajian' => GeneralLabel::kategori_pengajian,
            'nama_pengajian_sekarang' => GeneralLabel::nama_pengajian_sekarang,
            'nama_pertukaran_pengajian' => GeneralLabel::nama_pertukaran_pengajian,
            'sebab_pertukaran' => GeneralLabel::sebab_pertukaran,
            'sebab_penangguhan' => GeneralLabel::sebab_penangguhan,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'kejohanan_program' => GeneralLabel::kejohanan_program,
            'tarikh' => GeneralLabel::tarikh,
            'tempat' => GeneralLabel::tempat,
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
}
