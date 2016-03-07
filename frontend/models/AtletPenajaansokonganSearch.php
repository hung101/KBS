<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPenajaansokongan;

/**
 * AtletPenajaansokonganSearch represents the model behind the search form about `app\models\AtletPenajaansokongan`.
 */
class AtletPenajaansokonganSearch extends AtletPenajaansokongan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penajaan_sokongan_id', 'atlet_id'], 'integer'],
            [['nama_syarikat', 'alamat_1', 'emel', 'no_telefon', 'peribadi_yang_bertanggungjawab', 'jenis_kontrak', 'tahun_permulaan', 'tahun_akhir', 'barang_yang_penyokong'], 'safe'],
            [['nilai_kontrak'], 'number'],
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
        $query = AtletPenajaansokongan::find();

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
            'penajaan_sokongan_id' => $this->penajaan_sokongan_id,
            'atlet_id' => $this->atlet_id,
            'nilai_kontrak' => $this->nilai_kontrak,
            'tahun_permulaan' => $this->tahun_permulaan,
            'tahun_akhir' => $this->tahun_akhir,
        ]);

        $query->andFilterWhere(['like', 'nama_syarikat', $this->nama_syarikat])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'peribadi_yang_bertanggungjawab', $this->peribadi_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'jenis_kontrak', $this->jenis_kontrak])
            ->andFilterWhere(['like', 'barang_yang_penyokong', $this->barang_yang_penyokong]);

        return $dataProvider;
    }
}
