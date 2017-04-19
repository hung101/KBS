<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefSoalanPeserta;

/**
 * RefSoalanPesertaSearch represents the model behind the search form about `app\models\RefSoalanPeserta`.
 */
class RefSoalanPesertaSearch extends RefSoalanPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated', 'ref_kategori_soalan_peserta_id'], 'safe'],
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
        $query = RefSoalanPeserta::find()->joinWith(['refKategoriSoalanPeserta']);

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
            'id' => $this->id,
            //'ref_kategori_soalan_peserta_id' => $this->ref_kategori_soalan_peserta_id,
            'aktif' => $this->aktif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc])
			->andFilterWhere(['like', 'tbl_ref_kategori_soalan_peserta.desc', $this->ref_kategori_soalan_peserta_id]);

        return $dataProvider;
    }
}
