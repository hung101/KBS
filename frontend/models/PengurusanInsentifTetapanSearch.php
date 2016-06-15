<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanInsentifTetapan;

/**
 * PengurusanInsentifTetapanSearch represents the model behind the search form about `app\models\PengurusanInsentifTetapan`.
 */
class PengurusanInsentifTetapanSearch extends PengurusanInsentifTetapan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_insentif_tetapan_id', 'created_by', 'updated_by'], 'integer'],
            [['sgar', 'sikap', 'siso_olimpik', 'siso_paralimpik', 'sito_emas', 'sito_perak', 'sito_gangsa'], 'number'],
            [['created', 'updated'], 'safe'],
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
        $query = PengurusanInsentifTetapan::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'pengurusan_insentif_tetapan_id' => $this->pengurusan_insentif_tetapan_id,
            'sgar' => $this->sgar,
            'sikap' => $this->sikap,
            'siso_olimpik' => $this->siso_olimpik,
            'siso_paralimpik' => $this->siso_paralimpik,
            'sito_emas' => $this->sito_emas,
            'sito_perak' => $this->sito_perak,
            'sito_gangsa' => $this->sito_gangsa,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        return $dataProvider;
    }
}
