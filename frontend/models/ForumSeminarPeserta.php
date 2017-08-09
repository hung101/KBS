<?php

namespace app\models;

use Yii;
use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * This is the model class for table "tbl_forum_seminar_peserta".
 *
 * @property integer $forum_seminar_peserta_id
 * @property integer $forum_seminar_persidangan_di_luar_negara_id
 * @property string $session_id
 * @property string $nama
 * @property string $jawatan
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class ForumSeminarPeserta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_forum_seminar_peserta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['nama'], 'required', 'skipOnEmpty' => true, 'message' => GeneralMessage::yii_validation_required],
            [['forum_seminar_persidangan_di_luar_negara_id', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['session_id'], 'string', 'max' => 100],
            [['nama', 'jawatan'], 'string', 'max' => 255],
            [['nama', 'jawatan'], 'filter', 'filter' => function ($value) {
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
            'forum_seminar_peserta_id' => 'Forum Seminar Peserta ID',
            'forum_seminar_persidangan_di_luar_negara_id' => 'Forum Seminar Persidangan Di Luar Negara ID',
            'session_id' => 'Session ID',
            'nama' => GeneralLabel::nama,
            'jawatan' => GeneralLabel::jawatan,
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
