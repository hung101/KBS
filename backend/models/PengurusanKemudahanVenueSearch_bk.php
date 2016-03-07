<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanKemudahanVenue;

/**
 * PengurusanKemudahanVenueSearch represents the model behind the search form about `app\models\PengurusanKemudahanVenue`.
 */
class PengurusanKemudahanVenueSearch extends PengurusanKemudahanVenue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_kemudahan_venue_id', 'public_user_id'], 'integer'],
            [['nama_venue', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'no_faks', 'pemilik', 'sewaan', 'status'], 'safe'],
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
        $query = PengurusanKemudahanVenue::find()
                ->joinWith(['refStatusVenue']);

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
            'pengurusan_kemudahan_venue_id' => $this->pengurusan_kemudahan_venue_id,
            'public_user_id' => $this->public_user_id,
        ]);

        $query->andFilterWhere(['like', 'nama_venue', $this->nama_venue])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'pemilik', $this->pemilik])
            ->andFilterWhere(['like', 'sewaan', $this->sewaan])
            ->andFilterWhere(['like', 'tbl_ref_status_venue.desc', $this->status]);

        return $dataProvider;
    }
}
