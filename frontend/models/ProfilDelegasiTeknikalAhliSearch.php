<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilDelegasiTeknikalAhli;

/**
 * ProfilDelegasiTeknikalAhliSearch represents the model behind the search form about `app\models\ProfilDelegasiTeknikalAhli`.
 */
class ProfilDelegasiTeknikalAhliSearch extends ProfilDelegasiTeknikalAhli
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_delegasi_teknikal_ahli_id', 'profil_delegasi_teknikal_id', 'umur', 'created_by', 'updated_by'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'jantina', 'tarikh_lahir', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'jawatan', 'no_telefon_bimbit', 'emel', 'pekerjaan', 'alamat_majikan_1', 'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'no_telefon_pejabat', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = ProfilDelegasiTeknikalAhli::find()
                ->joinWith(['refJantina'])
                ->joinWith(['refJawatanDelegasiTeknikal']);

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
            'profil_delegasi_teknikal_ahli_id' => $this->profil_delegasi_teknikal_ahli_id,
            'profil_delegasi_teknikal_id' => $this->profil_delegasi_teknikal_id,
            //'jantina' => $this->jantina,
            'tarikh_lahir' => $this->tarikh_lahir,
            'umur' => $this->umur,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'tbl_ref_jantina.desc', $this->jantina])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'tbl_ref_jawatan_delegasi_teknikal.desc', $this->jawatan])
            ->andFilterWhere(['like', 'no_telefon_bimbit', $this->no_telefon_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'pekerjaan', $this->pekerjaan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
