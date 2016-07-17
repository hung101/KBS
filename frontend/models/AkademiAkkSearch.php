<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AkademiAkk;

/**
 * AkademiAkkSearch represents the model behind the search form about `app\models\AkademiAkk`.
 */
class AkademiAkkSearch extends AkademiAkk
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akademi_akk_id', 'tahun'], 'integer'],
            [['nama', 'muatnaik_gambar', 'no_kad_pengenalan', 'no_passport', 'tarikh_lahir', 'tempat_lahir', 'no_telefon', 'emel', 'nama_majikan', 
                'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 
                'no_telefon_pejabat', 'kategori_pensijilan', 'jenis_sukan'], 'safe'],
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
        $query = AkademiAkk::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refKategoriPensijilanAkademiAkk']);

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
            'akademi_akk_id' => $this->akademi_akk_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'tahun' => $this->tahun,
        ]);

        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama])
            ->andFilterWhere(['like', 'muatnaik_gambar', $this->muatnaik_gambar])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'no_passport', $this->no_passport])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat])
            ->andFilterWhere(['like', 'tbl_ref_kategori_pensijilan_akademi_akk.desc', $this->kategori_pensijilan])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->jenis_sukan]);

        return $dataProvider;
    }
}
