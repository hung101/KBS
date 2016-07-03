<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanElaun;

/**
 * BantuanElaunSearch represents the model behind the search form about `app\models\BantuanElaun`.
 */
class BantuanElaunSearch extends BantuanElaun
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_elaun_id', 'umur', 'created_by'], 'integer'],
            [['nama', 'muatnaik_gambar', 'no_kad_pengenalan', 'tarikh_lahir', 'jantina', 'kewarganegara', 'bangsa', 'agama', 'kelayakan_akademi', 'alamat_1', 'alamat_2', 
                'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 'emel', 'kontrak', 'muatnaik_dokumen', 'status_permohonan', 
                'catatan', 'jenis_bantuan', 'nama_persatuan'], 'safe'],
            [['jumlah_elaun'], 'number'],
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
        $query = BantuanElaun::find()
                ->joinWith(['refJenisBantuanSue'])
                ->joinWith(['refProfilBadanSukan'])
                ->joinWith(['refStatusPermohonanSue']);

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
            'bantuan_elaun_id' => $this->bantuan_elaun_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'umur' => $this->umur,
            'jumlah_elaun' => $this->jumlah_elaun,
            'tbl_bantuan_elaun.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'muatnaik_gambar', $this->muatnaik_gambar])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'kewarganegara', $this->kewarganegara])
            ->andFilterWhere(['like', 'bangsa', $this->bangsa])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'kelayakan_akademi', $this->kelayakan_akademi])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'kontrak', $this->kontrak])
            ->andFilterWhere(['like', 'muatnaik_dokumen', $this->muatnaik_dokumen])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_sue.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_ref_jenis_bantuan_sue.desc', $this->jenis_bantuan])
                ->andFilterWhere(['like', 'tbl_profil_bandan_sukan.nama_badan_sukan', $this->nama_persatuan]);

        return $dataProvider;
    }
}
