<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanInsentif;

/**
 * PengurusanInsentifSearch represents the model behind the search form about `app\models\PengurusanInsentif`.
 */
class PengurusanInsentifSearch extends PengurusanInsentif
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_insentif_id', 'kelulusan'], 'integer'],
            [['nama_insentif', 'atlet_id', 'kumpulan', 'rekod_baru', 'nama_sukan', 'kelayakan_pingat', 'sgar_nama_jurulatih', 'sikap_nama_persatuan', 'siso_tarikh_kelayakan', 'sisi_tarikh_olimpik', 'sito_nama_acara_di_olimpik', 'sito_pingat', 'category_insentif'], 'safe'],
            [['jumlah_insentif', 'jumlah_sgar', 'jumlah_sikap', 'jumlah_siso', 'jumlah_sito'], 'number'],
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
        $query = PengurusanInsentif::find()
                ->joinWith(['atlet'])
                ->joinWith(['refNamaInsentif'])
                ->joinWith(['refKumpulan'])
                ->joinWith(['refRekodBaru']);

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
            'pengurusan_insentif_id' => $this->pengurusan_insentif_id,
            //'atlet_id' => $this->atlet_id,
            'jumlah_insentif' => $this->jumlah_insentif,
            'jumlah_sgar' => $this->jumlah_sgar,
            'jumlah_sikap' => $this->jumlah_sikap,
            'siso_tarikh_kelayakan' => $this->siso_tarikh_kelayakan,
            'sisi_tarikh_olimpik' => $this->sisi_tarikh_olimpik,
            'jumlah_siso' => $this->jumlah_siso,
            'jumlah_sito' => $this->jumlah_sito,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_nama_insentif.desc', $this->nama_insentif])
            ->andFilterWhere(['like', 'tbl_ref_kumpulan.desc', $this->kumpulan])
            ->andFilterWhere(['like', 'tbl_ref_rekod_baru.desc', $this->rekod_baru])
            ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'kelayakan_pingat', $this->kelayakan_pingat])
            ->andFilterWhere(['like', 'sgar_nama_jurulatih', $this->sgar_nama_jurulatih])
            ->andFilterWhere(['like', 'sikap_nama_persatuan', $this->sikap_nama_persatuan])
            ->andFilterWhere(['like', 'sito_nama_acara_di_olimpik', $this->sito_nama_acara_di_olimpik])
            ->andFilterWhere(['like', 'sito_pingat', $this->sito_pingat])
            ->andFilterWhere(['like', 'category_insentif', $this->category_insentif]);

        return $dataProvider;
    }
}
