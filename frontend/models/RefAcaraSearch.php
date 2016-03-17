<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefAcara;

/**
 * RefAcaraSearch represents the model behind the search form about `app\models\RefAcara`.
 */
class RefAcaraSearch extends RefAcara
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif'], 'integer'],
            [['desc', 'ref_sukan_id'], 'safe'],
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
        $query = RefAcara::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('refSukan');

        $query->andFilterWhere([
            'id' => $this->id,
            'aktif' => $this->aktif,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->ref_sukan_id]);

        return $dataProvider;
    }
}
