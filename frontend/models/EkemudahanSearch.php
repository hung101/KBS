<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ekemudahan;

/**
 * EkemudahanSearch represents the model behind the search form about `app\models\Ekemudahan`.
 */
class EkemudahanSearch extends Ekemudahan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ekemudahan_id'], 'integer'],
            [['kategori', 'jenis', 'gambar', 'lokasi', 'dihubungi', 'url', 'nama_perniagaan_perkhidmatan_organisasi', 'kapasiti_penggunaan', 'no_lesen_pendaftaran'], 'safe'],
            [['kadar_sewa'], 'number'],
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
        $query = Ekemudahan::find();

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
            'ekemudahan_id' => $this->ekemudahan_id,
            'kadar_sewa' => $this->kadar_sewa,
        ]);

        $query->andFilterWhere(['like', 'kategori', $this->kategori])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'dihubungi', $this->dihubungi])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'nama_perniagaan_perkhidmatan_organisasi', $this->nama_perniagaan_perkhidmatan_organisasi])
            ->andFilterWhere(['like', 'kapasiti_penggunaan', $this->kapasiti_penggunaan])
            ->andFilterWhere(['like', 'no_lesen_pendaftaran', $this->no_lesen_pendaftaran]);

        return $dataProvider;
    }
}
