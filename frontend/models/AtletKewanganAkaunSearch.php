<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKewanganAkaun;

/**
 * AtletKewanganAkaunSearch represents the model behind the search form about `app\models\AtletKewanganAkaun`.
 */
class AtletKewanganAkaunSearch extends AtletKewanganAkaun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akaun_id', 'atlet_id'], 'integer'],
            [['nama_bank', 'cawangan', 'no_akaun', 'jenis_akaun'], 'safe'],
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
        $query = AtletKewanganAkaun::find()
                ->joinWith(['refBank'])
                ->joinWith(['refJenisBankAkaun']);

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
            'akaun_id' => $this->akaun_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_bank.desc', $this->nama_bank])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'no_akaun', $this->no_akaun])
            ->andFilterWhere(['like', 'tbl_ref_jenis_bank_akaun.desc', $this->jenis_akaun]);

        return $dataProvider;
    }
}
