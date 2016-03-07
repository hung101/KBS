<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\RefKategoriPenganjuranSub;

/**
 * RefKategoriPenganjuranSubSearch represents the model behind the search form about `app\models\RefKategoriPenganjuranSub`.
 */
class RefKategoriPenganjuranSubSearch extends RefKategoriPenganjuranSub
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ref_kategori_penganjuran_id', 'aktif', 'created_by', 'updated_by'], 'integer'],
            [['desc', 'created', 'updated'], 'safe'],
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
        $query = RefKategoriPenganjuranSub::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'ref_kategori_penganjuran_id' => $this->ref_kategori_penganjuran_id,
            'aktif' => $this->aktif,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'desc', $this->desc]);

        return $dataProvider;
    }
}
