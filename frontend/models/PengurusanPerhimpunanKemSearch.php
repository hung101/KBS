<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPerhimpunanKem;

/**
 * PengurusanPerhimpunanKemSearch represents the model behind the search form about `app\models\PengurusanPerhimpunanKem`.
 */
class PengurusanPerhimpunanKemSearch extends PengurusanPerhimpunanKem
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_perhimpunan_kem_id', 'jumlah_peserta', 'sokongan_pn', 'kelulusan'], 'integer'],
            [['nama_ppn', 'pengurus_pn', 'nama_penganjuran', 'kategori_penganjuran', 'sub_kategori_penganjuran', 'tahap_penganjuran', 'negeri', 'kategori_sukan', 'tarikh_penganjuran', 'activiti', 'tempat'], 'safe'],
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
        $query = PengurusanPerhimpunanKem::find()
                ->joinWith(['refKategoriPenganjuran']);

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
            'pengurusan_perhimpunan_kem_id' => $this->pengurusan_perhimpunan_kem_id,
            'tarikh_penganjuran' => $this->tarikh_penganjuran,
            'jumlah_peserta' => $this->jumlah_peserta,
            'sokongan_pn' => $this->sokongan_pn,
            'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'nama_ppn', $this->nama_ppn])
            ->andFilterWhere(['like', 'pengurus_pn', $this->pengurus_pn])
            ->andFilterWhere(['like', 'nama_penganjuran', $this->nama_penganjuran])
            ->andFilterWhere(['like', 'tbl_ref_kategori_penganjuran.desc', $this->kategori_penganjuran])
            ->andFilterWhere(['like', 'sub_kategori_penganjuran', $this->sub_kategori_penganjuran])
            ->andFilterWhere(['like', 'tahap_penganjuran', $this->tahap_penganjuran])
            ->andFilterWhere(['like', 'negeri', $this->negeri])
            ->andFilterWhere(['like', 'kategori_sukan', $this->kategori_sukan])
            ->andFilterWhere(['like', 'activiti', $this->activiti])
            ->andFilterWhere(['like', 'tempat', $this->tempat]);

        return $dataProvider;
    }
}
