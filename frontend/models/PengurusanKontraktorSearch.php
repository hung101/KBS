<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKontraktor;

/**
 * PengurusanKontraktorSearch represents the model behind the search form about `app\models\PengurusanKontraktor`.
 */
class PengurusanKontraktorSearch extends PengurusanKontraktor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kontraktor_id'], 'integer'],
            [['nama_kontraktor', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'telefon_pejabat', 'telefon_bimbit', 'peralatan_yang_dibekal'], 'safe'],
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
        $query = PengurusanKontraktor::find();

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
            'pengurusan_kontraktor_id' => $this->pengurusan_kontraktor_id,
        ]);

        $query->andFilterWhere(['like', 'nama_kontraktor', $this->nama_kontraktor])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'telefon_pejabat', $this->telefon_pejabat])
            ->andFilterWhere(['like', 'telefon_bimbit', $this->telefon_bimbit])
            ->andFilterWhere(['like', 'peralatan_yang_dibekal', $this->peralatan_yang_dibekal]);

        return $dataProvider;
    }
}
