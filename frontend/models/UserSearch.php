<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\User;
use app\models\RefJabatanUser;

/**
 * UserSearch represents the model behind the search form about `app\models\User`.
 */
class UserSearch extends User
{
    public $nama_peranan;
    public $ipt_bendahari_e_biasiswa_desc;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'peranan', 'ipt_bendahari_e_biasiswa', 'created_by'], 'integer'],
            [['username', 'jabatan_id', 'auth_key', 'password_hash', 'password_reset_token', 'full_name', 'tel_mobile_no', 'tel_no', 'email', 
                'no_kad_pengenalan', 'nama_peranan', 'ipt_bendahari_e_biasiswa_desc'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = User::find()
                ->joinWith(['refJabatanUser'])
                ->joinWith(['refUserPeranan'])
                ->joinWith(['refUniversitiInstitusiEBiasiswa']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $dataProvider->sort->attributes['nama_peranan'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_user_peranan.nama_peranan' => SORT_ASC],
            'desc' => ['tbl_user_peranan.nama_peranan' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['ipt_bendahari_e_biasiswa_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_ref_universiti_institusi_e_biasiswa.desc' => SORT_ASC],
            'desc' => ['tbl_ref_universiti_institusi_e_biasiswa.desc' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'tbl_user.id' => $this->id,
            //'jabatan_id' => $this->jabatan_id,
            'peranan' => $this->peranan,
            'status' => $this->status,
            'ipt_bendahari_e_biasiswa' => $this->ipt_bendahari_e_biasiswa,
            'tbl_user.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'tel_mobile_no', $this->tel_mobile_no])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'tbl_ref_jabatan_user.desc', $this->jabatan_id])
                ->andFilterWhere(['like', 'tbl_user_peranan.nama_peranan', $this->nama_peranan])
                ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
                ->andFilterWhere(['like', 'tbl_ref_universiti_institusi_e_biasiswa.desc', $this->ipt_bendahari_e_biasiswa_desc]);
        
        
        // filter by agency
        $filterAgency=array();
        
        if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['msn'])){
            $filterAgency[] = RefJabatanUser::MSN;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['isn'])){
            $filterAgency[] = RefJabatanUser::ISN;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['pjs'])){
            $filterAgency[] = RefJabatanUser::PJS;
        }
        
        if(isset(Yii::$app->user->identity->peranan_akses['Admin']['user']['kbs'])){
            $filterAgency[] = RefJabatanUser::KBS;
        }
        
        if(count($filterAgency) > 0){
            $query->andFilterWhere(['in', 'jabatan_id', $filterAgency]);
        }
        
        // show child users only under parent
        if(Yii::$app->user->identity->peranan != \app\models\UserPeranan::PERANAN_ADMIN){
            //$queryParams['UserSearch']['created_by'] = Yii::$app->user->identity->id;
            $query->andWhere(new \yii\db\Expression('FIND_IN_SET(:parent_id, parent_path)'))->addParams([':parent_id' => Yii::$app->user->identity->id])
                    ->orFilterWhere(['tbl_user.created_by' => Yii::$app->user->identity->id]);
        }
        
        return $dataProvider;
    }
}
