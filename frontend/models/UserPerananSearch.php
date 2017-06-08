<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserPeranan;

/**
 * UserPerananSearch represents the model behind the search form about `app\models\UserPeranan`.
 */
class UserPerananSearch extends UserPeranan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_peranan_id', 'created_by'], 'integer'],
            [['nama_peranan', 'peranan_akses', 'aktif'], 'safe'],
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
        $query = UserPeranan::find()
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
            'user_peranan_id' => $this->user_peranan_id,
            //'aktif' => $this->aktif,
            'tbl_user_peranan.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'nama_peranan', $this->nama_peranan])
            ->andFilterWhere(['like', 'peranan_akses', $this->peranan_akses])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->aktif]);

        return $dataProvider;
    }
}
