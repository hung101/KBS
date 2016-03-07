<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KemudahPakaianPeralatanTiket;

/**
 * KemudahPakaianPeralatanTiketSearch represents the model behind the search form about `app\models\KemudahPakaianPeralatanTiket`.
 */
class KemudahPakaianPeralatanTiketSearch extends KemudahPakaianPeralatanTiket
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kemudah_pakaian_peralatan_tiket_id', 'atlet_id', 'kelulusan'], 'integer'],
            [['kategori_permohonan', 'tarikh_diperlukan_pergi', 'tarikh_dijangka_dipulangkan_balik', 'destinasi_daripada', 'destinasi_ke', 'ulasan_permohonan'], 'safe'],
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
        $query = KemudahPakaianPeralatanTiket::find();

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
            'kemudah_pakaian_peralatan_tiket_id' => $this->kemudah_pakaian_peralatan_tiket_id,
            'atlet_id' => $this->atlet_id,
            'tarikh_diperlukan_pergi' => $this->tarikh_diperlukan_pergi,
            'tarikh_dijangka_dipulangkan_balik' => $this->tarikh_dijangka_dipulangkan_balik,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'kategori_permohonan', $this->kategori_permohonan])
            ->andFilterWhere(['like', 'destinasi_daripada', $this->destinasi_daripada])
            ->andFilterWhere(['like', 'destinasi_ke', $this->destinasi_ke])
            ->andFilterWhere(['like', 'ulasan_permohonan', $this->ulasan_permohonan]);

        return $dataProvider;
    }
}
