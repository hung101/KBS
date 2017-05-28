<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sukarelawan;

/**
 * SukarelawanSearch represents the model behind the search form about `app\models\Sukarelawan`.
 */
class SukarelawanSearch extends Sukarelawan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sukarelawan_id', 'kebatasan_fizikal'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'tarikh_lahir', 'jantina', 'no_tel_bimbit', 'status', 'emel', 'facebook', 'menyatakan_jika_ada_kebatasan_fizikal', 'kelulusan_akademi', 'bidang_kepakaran', 'pekerjaan_semasa', 'nama_majikan', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'bidang_diminati', 'waktu_ketika_diperlukan', 'menyatakan_waktu_ketika_diperlukan', 'muatnaik'], 'safe'],
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
        $query = Sukarelawan::find()
                ->joinWith(['refJantina'])
                ->joinWith(['refBandar'])
                ->joinWith(['refNegeri']);

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
            'sukarelawan_id' => $this->sukarelawan_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'kebatasan_fizikal' => $this->kebatasan_fizikal,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->alamat_negeri])
            ->andFilterWhere(['like', 'tbl_ref_bandar.desc', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'facebook', $this->facebook])
            ->andFilterWhere(['like', 'menyatakan_jika_ada_kebatasan_fizikal', $this->menyatakan_jika_ada_kebatasan_fizikal])
            ->andFilterWhere(['like', 'kelulusan_akademi', $this->kelulusan_akademi])
            ->andFilterWhere(['like', 'bidang_kepakaran', $this->bidang_kepakaran])
            ->andFilterWhere(['like', 'pekerjaan_semasa', $this->pekerjaan_semasa])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
            ->andFilterWhere(['like', 'bidang_diminati', $this->bidang_diminati])
            ->andFilterWhere(['like', 'waktu_ketika_diperlukan', $this->waktu_ketika_diperlukan])
            ->andFilterWhere(['like', 'menyatakan_waktu_ketika_diperlukan', $this->menyatakan_waktu_ketika_diperlukan])
            ->andFilterWhere(['like', 'muatnaik', $this->muatnaik]);

        return $dataProvider;
    }
}
