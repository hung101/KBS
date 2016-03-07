<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KeputusanAnalisiTubuhBadan;

/**
 * KeputusanAnalisiTubuhBadanSearch represents the model behind the search form about `app\models\KeputusanAnalisiTubuhBadan`.
 */
class KeputusanAnalisiTubuhBadanSearch extends KeputusanAnalisiTubuhBadan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keputusan_analisi_tubuh_badan_id', 'perkhidmatan_permakanan_id'], 'integer'],
            [['kategori_atlet', 'sukan', 'acara', 'atlet', 'fit', 'unfit', 'refer', 'session_id'], 'safe'],
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
        $query = KeputusanAnalisiTubuhBadan::find()
                ->joinWith(['refAtlet']);

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
            'keputusan_analisi_tubuh_badan_id' => $this->keputusan_analisi_tubuh_badan_id,
            'perkhidmatan_permakanan_id' => $this->perkhidmatan_permakanan_id,
        ]);

        $query->andFilterWhere(['like', 'kategori_atlet', $this->kategori_atlet])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'acara', $this->acara])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet])
            ->andFilterWhere(['like', 'fit', $this->fit])
            ->andFilterWhere(['like', 'unfit', $this->unfit])
            ->andFilterWhere(['like', 'refer', $this->refer])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
