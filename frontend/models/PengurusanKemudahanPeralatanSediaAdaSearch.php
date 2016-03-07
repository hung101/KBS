<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanPeralatanSediaAda;

/**
 * PengurusanKemudahanPeralatanSediaAdaSearch represents the model behind the search form about `app\models\PengurusanKemudahanPeralatanSediaAda`.
 */
class PengurusanKemudahanPeralatanSediaAdaSearch extends PengurusanKemudahanPeralatanSediaAda
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_peralatan_sedia_ada_id', 'pengurusan_kemudahan_venue_id', 'kuantiti'], 'integer'],
            [['nama_peralatan'], 'safe'],
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
        $query = PengurusanKemudahanPeralatanSediaAda::find()
                ->joinWith(['refPeralatanKemudahan']);

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
            'pengurusan_kemudahan_peralatan_sedia_ada_id' => $this->pengurusan_kemudahan_peralatan_sedia_ada_id,
            'pengurusan_kemudahan_venue_id' => $this->pengurusan_kemudahan_venue_id,
            'kuantiti' => $this->kuantiti,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_peralatan_kemudahan.desc', $this->nama_peralatan]);

        return $dataProvider;
    }
}
