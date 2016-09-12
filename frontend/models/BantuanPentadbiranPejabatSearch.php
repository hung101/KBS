<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BantuanPentadbiranPejabat;

/**
 * BantuanPentadbiranPejabatSearch represents the model behind the search form about `app\models\BantuanPentadbiranPejabat`.
 */
class BantuanPentadbiranPejabatSearch extends BantuanPentadbiranPejabat
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bantuan_pentadbiran_pejabat_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'tarikh_lahir', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_tel_bimbit', 
                'status_permohonan', 'catatan', 'persatuan', 'jawatan'], 'safe'],
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
        $query = BantuanPentadbiranPejabat::find()
                ->joinWith(['refStatusPermohonanBantuanPentadbiranPejabat'])
                ->joinWith(['refProfilBadanSukan'])
                ->joinWith(['refJawatanBantuanPentadbiranPejabat']);

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
            'bantuan_pentadbiran_pejabat_id' => $this->bantuan_pentadbiran_pejabat_id,
            'tarikh_lahir' => $this->tarikh_lahir,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_bantuan_pentadbiran_pejabat.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->persatuan])
                ->andFilterWhere(['like', 'tbl_ref_jawatan_bantuan_pentadbiran_pejabat.desc', $this->jawatan]);

        return $dataProvider;
    }
}
