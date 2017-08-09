<?php

namespace app\models;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

use Yii;

/**
 * This is the model class for table "tbl_laporan_pemantauan_jurulatih".
 *
 * @property integer $laporan_pemantauan_jurulatih_id
 * @property integer $jurulatih_id
 * @property integer $sukan_id
 * @property integer $program_id
 * @property string $pusat_latihan
 * @property string $nama_pegawai
 * @property string $tarikh_dinilai
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class LaporanPemantauanJurulatih extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_laporan_pemantauan_jurulatih';
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
            [['jurulatih_id'], 'required'],
            [['jurulatih_id', 'sukan_id', 'program_id', 'created_by', 'updated_by'], 'integer'],
            [['tarikh_dinilai', 'created', 'updated'], 'safe'],
            [['pusat_latihan', 'nama_pegawai'], 'string', 'max' => 255],
            [['pusat_latihan', 'nama_pegawai'], 'filter', 'filter' => function ($value) {
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
            'laporan_pemantauan_jurulatih_id' => 'Laporan Pemantauan Jurulatih ID',
            'jurulatih_id' => GeneralLabel::jurulatih,
            'sukan_id' => GeneralLabel::sukan,
            'program_id' => GeneralLabel::program,
            'pusat_latihan' => GeneralLabel::pusat_latihan,
            'nama_pegawai' => GeneralLabel::nama_pegawai,
            'tarikh_dinilai' => GeneralLabel::tarikh,
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
        return $this->hasOne(Jurulatih::className(), ['jurulatih_id' => 'jurulatih_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefSukan(){
        return $this->hasOne(RefSukan::className(), ['id' => 'sukan_id']);
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefProgram(){
        return $this->hasOne(RefProgramSemasaSukanAtlet::className(), ['id' => 'program_id']);
    }
}
