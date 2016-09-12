<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahPencalonanKepimpinanSukanJawatan;

/**
 * AnugerahPencalonanKepimpinanSukanJawatanSearch represents the model behind the search form about `app\models\AnugerahPencalonanKepimpinanSukanJawatan`.
 */
class AnugerahPencalonanKepimpinanSukanJawatanSearch extends AnugerahPencalonanKepimpinanSukanJawatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_pencalonan_lain_jawatan_id', 'anugerah_pencalonan_lain_id', 'created_by', 'updated_by'], 'integer'],
            [['jawatan', 'nama_persatuan_pertubuhan', 'tempoh', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = AnugerahPencalonanKepimpinanSukanJawatan::find();

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
            'anugerah_pencalonan_lain_jawatan_id' => $this->anugerah_pencalonan_lain_jawatan_id,
            'anugerah_pencalonan_lain_id' => $this->anugerah_pencalonan_lain_id,
            'tempoh' => $this->tempoh,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'nama_persatuan_pertubuhan', $this->nama_persatuan_pertubuhan])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
