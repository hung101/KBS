<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BorangAduanKerosakanJenisKerosakan;

/**
 * BorangAduanKerosakanJenisKerosakanSearch represents the model behind the search form about `app\models\BorangAduanKerosakanJenisKerosakan`.
 */
class BorangAduanKerosakanJenisKerosakanSearch extends BorangAduanKerosakanJenisKerosakan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['borang_aduan_kerosakan_jenis_kerosakan_id', 'borang_aduan_kerosakan_id', 'selesai', 'created_by', 'updated_by'], 'integer'],
            [['lokasi', 'jenis_kerosakan', 'nama_pemeriksa', 'tarikh_pemeriksaan', 'kategori_kerosakan', 'tindakan', 'catatan', 'ulasan_pemeriksa', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = BorangAduanKerosakanJenisKerosakan::find()
                ->joinWith(['refNamaPemeriksaAduan'])
                ->joinWith(['refKategoriKerosakan'])
                ->joinWith(['refKelulusan']);

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
            'borang_aduan_kerosakan_jenis_kerosakan_id' => $this->borang_aduan_kerosakan_jenis_kerosakan_id,
            'borang_aduan_kerosakan_id' => $this->borang_aduan_kerosakan_id,
            'tarikh_pemeriksaan' => $this->tarikh_pemeriksaan,
            'selesai' => $this->selesai,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'jenis_kerosakan', $this->jenis_kerosakan])
            ->andFilterWhere(['like', 'nama_pemeriksa', $this->nama_pemeriksa])
            ->andFilterWhere(['like', 'kategori_kerosakan', $this->kategori_kerosakan])
            ->andFilterWhere(['like', 'tindakan', $this->tindakan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'ulasan_pemeriksa', $this->ulasan_pemeriksa])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
