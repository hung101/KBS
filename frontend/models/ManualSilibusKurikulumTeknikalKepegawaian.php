<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_manual_silibus_kurikulum_teknikal_kepegawaian".
 *
 * @property integer $manual_silibus_kurikulum_teknikal_kepegawaian_id
 * @property string $persatuan_sukan
 * @property string $jilid_versi
 * @property string $tarikh
 * @property string $muat_naik
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ManualSilibusKurikulumTeknikalKepegawaian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_manual_silibus_kurikulum_teknikal_kepegawaian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tarikh', 'persatuan_sukan', 'jilid_versi', 'muat_naik'], 'required'],
            [['tarikh', 'created', 'updated'], 'safe'],
            [['created_by', 'updated_by'], 'integer'],
            [['persatuan_sukan', 'jilid_versi'], 'string', 'max' => 30],
            [['muat_naik'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'manual_silibus_kurikulum_teknikal_kepegawaian_id' => 'Manual Silibus Kurikulum Teknikal Kepegawaian ID',
            'persatuan_sukan' => 'Persatuan Sukan',
            'jilid_versi' => 'Jilid / Versi',
            'tarikh' => 'Tarikh',
            'muat_naik' => 'Muat Naik',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
