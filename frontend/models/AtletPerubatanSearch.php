<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPerubatan;

/**
 * AtletPerubatanSearch represents the model behind the search form about `app\models\AtletPerubatan`.
 */
class AtletPerubatanSearch extends AtletPerubatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perubatan_id', 'atlet_id'], 'integer'],
            [['kumpulan_darah', 'alergi_makanan', 'alergi_perubatan', 'alergi_jenis_lain', 'penyakit_semula_jadi'], 'safe'],
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
        $query = AtletPerubatan::find()
                ->joinWith(['refKumpulanDarah'])
                ->joinWith(['refStafPerubatanYangBertanggungjawab']);

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
            'perubatan_id' => $this->perubatan_id,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'kumpulan_darah', $this->kumpulan_darah])
            ->andFilterWhere(['like', 'alergi_makanan', $this->alergi_makanan])
            ->andFilterWhere(['like', 'alergi_perubatan', $this->alergi_perubatan])
            ->andFilterWhere(['like', 'alergi_jenis_lain', $this->alergi_jenis_lain])
            ->andFilterWhere(['like', 'penyakit_semula_jadi', $this->penyakit_semula_jadi]);

        return $dataProvider;
    }
}
