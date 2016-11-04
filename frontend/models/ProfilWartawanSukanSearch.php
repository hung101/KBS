<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilWartawanSukan;

/**
 * ProfilWartawanSukanSearch represents the model behind the search form about `app\models\ProfilWartawanSukan`.
 */
class ProfilWartawanSukanSearch extends ProfilWartawanSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_wartawan_sukan_id'], 'integer'],
            [['nama', 'emel', 'agensi', 'no_tel', 'aktif'], 'safe'],
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
        $query = ProfilWartawanSukan::find()
                ->joinWith(['refKelulusan']);

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
            'profil_wartawan_sukan_id' => $this->profil_wartawan_sukan_id,
            'agensi' => $this->agensi,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'emel', $this->emel])
            //->andFilterWhere(['like', 'agensi', $this->agensi])
            ->andFilterWhere(['like', 'no_tel', $this->no_tel])
            ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->aktif]);

        return $dataProvider;
    }
}
