<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user_public".
 *
 * @property integer $id
 * @property string $username
 * @property integer $category_access
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $full_name
 * @property string $tel_bimbit_no
 * @property string $tel_no
 * @property string $email
 * @property string $fax_no
 * @property integer $jenis_pengguna_e_kemudahan
 * @property integer $kategory_hakmilik_e_kemudahan
 * @property string $nama_persatuan_e_bantuan
 * @property string $jawatan_e_bantuan
 * @property string $sijil_pendaftaran
 * @property integer $status
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $created
 * @property string $updated
 */
class UserPublic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_user_public';
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
            [['category_access', 'jenis_pengguna_e_kemudahan', 'kategory_hakmilik_e_kemudahan', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'sijil_pendaftaran'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['full_name', 'nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], 'string', 'max' => 80],
            [['tel_bimbit_no', 'tel_no', 'fax_no'], 'integer', 'message' => GeneralMessage::yii_validation_integer],            
            [['tel_bimbit_no', 'tel_no', 'fax_no'], 'string', 'max' => 14],
            [['username', 'full_name', 'nama_persatuan_e_bantuan', 'jawatan_e_bantuan'], function ($attribute, $params) {
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
            'id' => 'ID',
            'username' => 'Username',
            'category_access' => 'Category Access',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'full_name' => 'Full Name',
            'tel_bimbit_no' => 'Tel Bimbit No',
            'tel_no' => 'Tel No',
            'email' => 'Email',
            'fax_no' => 'Fax No',
            'jenis_pengguna_e_kemudahan' => 'Jenis Pengguna E Kemudahan',
            'kategory_hakmilik_e_kemudahan' => 'Kategory Hakmilik E Kemudahan',
            'nama_persatuan_e_bantuan' => 'Nama Persatuan E Bantuan',
            'jawatan_e_bantuan' => 'Jawatan E Bantuan',
            'sijil_pendaftaran' => 'Sijil Pendaftaran',
            'status' => 'Status',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }
}
