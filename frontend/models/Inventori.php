<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_inventori".
 *
 * @property integer $inventori_id
 * @property string $tarikh
 * @property string $program
 * @property string $sukan
 * @property string $no_co
 * @property string $alamat_pembekal_1
 * @property string $alamat_pembekal_2
 * @property string $alamat_pembekal_3
 * @property string $alamat_pembekal_negeri
 * @property string $alamat_pembekal_bandar
 * @property string $alamat_pembekal_poskod
 * @property string $perkara
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class Inventori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_inventori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sukan', 'tarikh', 'negeri'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['tarikh', 'created', 'updated', 'tarikh_terima', 'tarikh_keluar', 'catatan'], 'safe'],
            [['perkara'], 'string'],
            [['created_by', 'updated_by'], 'integer'],
            [['program', 'sukan', 'no_co', 'alamat_pembekal_1', 'alamat_pembekal_2', 'alamat_pembekal_3'], 'string', 'max' => 30],
            [['alamat_pembekal_negeri'], 'string', 'max' => 3],
            [['alamat_pembekal_poskod'], 'integer', 'message' => GeneralMessage::yii_validation_integer],
            [['alamat_pembekal_bandar', 'alamat_pembekal_poskod'], 'string', 'max' => 5],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'inventori_id' => 'Inventori ID',
            'tarikh' => GeneralLabel::tarikh,
            'program' => GeneralLabel::program,
            'sukan' => GeneralLabel::sukan,
            'no_co' => GeneralLabel::no_co,
            'alamat_pembekal_1' => GeneralLabel::alamat_pembekal,
            'alamat_pembekal_2' => '',
            'alamat_pembekal_3' => '',
            'alamat_pembekal_negeri' => GeneralLabel::negeri,
            'alamat_pembekal_bandar' => GeneralLabel::bandar,
            'alamat_pembekal_poskod' => GeneralLabel::poskod,
            'perkara' => GeneralLabel::perkara,
            'tarikh_terima' => GeneralLabel::tarikh_terima,
            'tarikh_keluar' => GeneralLabel::tarikh_keluar,
            'catatan' => GeneralLabel::catatan,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefNegeri(){
        return $this->hasOne(RefNegeri::className(), ['id' => 'negeri']);
    }
}
