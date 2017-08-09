<?php

namespace app\models;
use yii\web\UploadedFile;
use app\models\general\Upload;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

use Yii;

/**
 * This is the model class for table "tbl_laporan_pemantauan_jurulatih_kategori".
 *
 * @property integer $laporan_pemantauan_jurulatih_kategori_id
 * @property integer $laporan_pemantauan_jurulatih_id
 * @property integer $penilaian_kategori
 * @property integer $penilaian_sub_kategori
 * @property string $session_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPemantauanJurulatihKategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_pemantauan_jurulatih_kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penilaian_kategori'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['laporan_pemantauan_jurulatih_id', 'penilaian_kategori', 'penilaian_sub_kategori', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            [['syor', 'ulasan', 'muat_naik'], 'string', 'max' => 255],
            [['muat_naik'], 'validateFileUpload', 'skipOnEmpty' => false],
            [['syor', 'ulasan'], 'filter', 'filter' => function ($value) {
                return  \common\models\general\GeneralFunction::filterXSS($value);
            }],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'laporan_pemantauan_jurulatih_kategori_id' => 'Laporan Pemantauan Jurulatih Kategori ID',
            'laporan_pemantauan_jurulatih_id' => 'Laporan Pemantauan Jurulatih ID',
            'penilaian_kategori' => GeneralLabel::pemerhatian,
            'penilaian_sub_kategori' => GeneralLabel::sub_kategori,
            'muat_naik' => GeneralLabel::upload,
            'session_id' => 'Session ID',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * Validate upload file cannot be empty
     */
    public function validateFileUpload($attribute, $params){
        $file = UploadedFile::getInstance($this, $attribute);
        
        if($file && $file->getHasError()){
            $this->addError($attribute, 'File error :' . Upload::getUploadErrorDesc($file->error));
        }
        
        if($file){
            if(!GeneralFunction::checkFileExtension($file->getExtension())){
                $this->addError($attribute, GeneralMessage::uploadFileTypeError);
            }
        }
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefKategoriLaporanPenilaianJurulatih(){
        return $this->hasOne(RefKategoriLaporanPenilaianJurulatih::className(), ['id' => 'penilaian_kategori']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSubKategoriLaporanPenilaianJurulatih(){
        return $this->hasOne(RefSubKategoriLaporanPenilaianJurulatih::className(), ['id' => 'penilaian_sub_kategori']);
    }
}
