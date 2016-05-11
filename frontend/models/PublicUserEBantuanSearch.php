<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PublicUserEBantuan;

/**
 * PublicUserEBantuanSearch represents the model behind the search form about `app\models\User`.
 */
class PublicUserEBantuanSearch extends PublicUserEBantuan
{
    public $nama_peranan;
    public $ipt_bendahari_e_biasiswa_desc;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['username', 'category_access', 'auth_key', 'password_hash', 'password_reset_token', 'full_name', 'tel_bimbit_no', 'tel_no', 'email', 'fax_no', 'jenis_pengguna_e_kemudahan', 'kategory_hakmilik_e_kemudahan', 'nama_persatuan_e_bantuan', 'jawatan_e_bantuan', 'status'], 'safe'],
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
        $query = PublicUserEBantuan::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'category_access' => $this->category_access,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'tel_bimbit_no', $this->tel_bimbit_no])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'fax_no', $this->fax_no])
                ->andFilterWhere(['like', 'jenis_pengguna_e_kemudahan', $this->jenis_pengguna_e_kemudahan])
                ->andFilterWhere(['like', 'kategory_hakmilik_e_kemudahan', $this->kategory_hakmilik_e_kemudahan])
                ->andFilterWhere(['like', 'jawatan_e_bantuan.desc', $this->jawatan_e_bantuan])
                ->andFilterWhere(['like', 'sijil_pendaftaran', $this->sijil_pendaftaran])
                ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
