<?php

namespace app\models;

use Yii;

use app\models\general\GeneralLabel;

/**
 * This is the model class for table "tbl_journal".
 *
 * @property integer $journal_id
 * @property string $nama_penulis
 * @property string $telefon_no
 * @property string $emel
 * @property string $alamat_1
 * @property string $alamat_2
 * @property string $alamat_3
 * @property string $alamat_negeri
 * @property string $alamat_bandar
 * @property string $alamat_poskod
 * @property string $tarikh_journal
 * @property string $bahagian
 * @property string $artikel_journal
 * @property string $status_journal
 */
class Journal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_journal';
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
            [['nama_penulis', 'telefon_no', 'alamat_1', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tarikh_journal', 'bahagian', 'artikel_journal'], 'required', 'skipOnEmpty' => true],
            [['tarikh_journal'], 'safe'],
            [['artikel_journal'], 'string'],
            [['nama_penulis'], 'string', 'max' => 80],
            [['telefon_no'], 'string', 'max' => 14],
            [['emel'], 'string', 'max' => 100],
            [['alamat_1', 'alamat_2', 'alamat_3'], 'string', 'max' => 90],
            [['alamat_negeri', 'bahagian', 'status_journal'], 'string', 'max' => 30],
            [['alamat_bandar'], 'string', 'max' => 40],
            [['alamat_poskod'], 'string', 'max' => 5]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'journal_id' => GeneralLabel::journal_id,
            'nama_penulis' => GeneralLabel::nama_penulis,
            'telefon_no' => GeneralLabel::telefon_no,
            'emel' => GeneralLabel::emel,
            'alamat_1' => GeneralLabel::alamat_1,
            'alamat_2' => GeneralLabel::alamat_2,
            'alamat_3' => GeneralLabel::alamat_3,
            'alamat_negeri' => GeneralLabel::alamat_negeri,
            'alamat_bandar' => GeneralLabel::alamat_bandar,
            'alamat_poskod' => GeneralLabel::alamat_poskod,
            'tarikh_journal' => GeneralLabel::tarikh_journal,
            'bahagian' => GeneralLabel::bahagian,
            'artikel_journal' => GeneralLabel::artikel_journal,
            'status_journal' => GeneralLabel::status_journal,

        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefStatusJournal(){
        return $this->hasOne(RefStatusJournal::className(), ['id' => 'status_journal']);
    }
}
