<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_ref_cawangan_e_laporan".
 *
 * @property integer $id
 * @property integer $ref_bahagian_e_laporan_id
 * @property string $desc
 * @property integer $aktif
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class RefCawanganELaporan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName() 
    {
        return 'tbl_ref_cawangan_e_laporan';
    }

    public function behaviors()
    {
        return [
            'bedezign\yii2\audit\AuditTrailBehavior',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ref_bahagian_e_laporan_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['desc'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => GeneralLabel::id,
            'ref_bahagian_e_laporan_id' => GeneralLabel::ref_bahagian_e_laporan_id,
            'desc' => GeneralLabel::desc,
            'aktif' => GeneralLabel::aktif,
            'created_by' => GeneralLabel::created_by,
            'updated_by' => GeneralLabel::updated_by,
            'created' => GeneralLabel::created,
            'updated' => GeneralLabel::updated,

        ];
    }

    public function getRefBahagianELaporan() {
        return $this->hasOne(RefBahagianELaporan::className(), ['id' => 'ref_bahagian_e_laporan_id']);
    }
}
