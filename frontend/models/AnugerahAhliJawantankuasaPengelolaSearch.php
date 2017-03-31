<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AnugerahAhliJawantankuasaPengelola;

/**
 * AnugerahAhliJawantankuasaPengelolaSearch represents the model behind the search form about `app\models\AnugerahAhliJawantankuasaPengelola`.
 */
class AnugerahAhliJawantankuasaPengelolaSearch extends AnugerahAhliJawantankuasaPengelola
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['anugerah_ahli_jawantankuasa_pengelola_id', 'created_by', 'updated_by', 'tahun'], 'integer'],
            [['ajk', 'nama', 'bahagian', 'created', 'updated'], 'safe'],
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
        $query = AnugerahAhliJawantankuasaPengelola::find()
                ->joinWith(['refAjk'])
                ->joinWith(['refBahagianAjk']);

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
            'anugerah_ahli_jawantankuasa_pengelola_id' => $this->anugerah_ahli_jawantankuasa_pengelola_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_ajk.desc', $this->ajk])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_bahagian_ajk.desc', $this->bahagian]);

        return $dataProvider;
    }
}
