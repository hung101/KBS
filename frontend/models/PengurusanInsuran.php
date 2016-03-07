<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_pengurusan_insuran".
 *
 * @property integer $pengurusan_insuran_id
 * @property integer $atlet_id
 * @property string $nama_insuran
 * @property string $jumlah_tuntutan
 * @property string $tarikh_tuntutan
 * @property string $pegawai_yang_bertanggungjawab
 */
class PengurusanInsuran extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_pengurusan_insuran';
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
            [['atlet_id', 'nama_insuran', 'jumlah_tuntutan', 'tarikh_tuntutan', 'pegawai_yang_bertanggungjawab'], 'required', 'skipOnEmpty' => true],
            [['atlet_id'], 'integer'],
            [['jumlah_tuntutan'], 'number'],
            [['tarikh_tuntutan', 'catatan'], 'safe'],
            [['nama_insuran', 'pegawai_yang_bertanggungjawab'], 'string', 'max' => 80]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'pengurusan_insuran_id' => 'Pengurusan Insuran ID',
            'atlet_id' => 'Atlet',
            'nama_insuran' => 'Nama Insuran',
            'jumlah_tuntutan' => 'Jumlah Tuntutan',
            'tarikh_tuntutan' => 'Tarikh Tuntutan',
            'pegawai_yang_bertanggungjawab' => 'Pegawai Yang Bertanggungjawab',
            'catatan' => 'Catatan',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAtlet(){
        return $this->hasOne(Atlet::className(), ['atlet_id' => 'atlet_id']);
    }
}
