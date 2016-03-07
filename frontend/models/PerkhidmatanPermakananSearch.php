<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PerkhidmatanPermakanan;

/**
 * PerkhidmatanPermakananSearch represents the model behind the search form about `app\models\PerkhidmatanPermakanan`.
 */
class PerkhidmatanPermakananSearch extends PerkhidmatanPermakanan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perkhidmatan_permakanan_id', 'permohonan_perkhidmatan_permakanan_id'], 'integer'],
            [['tarikh', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas'], 'safe'],
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
        $query = PerkhidmatanPermakanan::find();

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
            'perkhidmatan_permakanan_id' => $this->perkhidmatan_permakanan_id,
            'permohonan_perkhidmatan_permakanan_id' => $this->permohonan_perkhidmatan_permakanan_id,
            'tarikh' => $this->tarikh,
        ]);

        $query->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas]);

        return $dataProvider;
    }
}
