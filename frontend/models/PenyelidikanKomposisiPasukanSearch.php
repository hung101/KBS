<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenyelidikanKomposisiPasukan;

/**
 * PenyelidikanKomposisiPasukanSearch represents the model behind the search form about `app\models\PenyelidikanKomposisiPasukan`.
 */
class PenyelidikanKomposisiPasukanSearch extends PenyelidikanKomposisiPasukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penyelidikan_komposisi_pasukan_id', 'permohonana_penyelidikan_id'], 'integer'],
            [['nama', 'pasukan', 'jawatan', 'telefon_no', 'emel', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'institusi_universiti_syarikat', 'session_id'], 'safe'],
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
        $query = PenyelidikanKomposisiPasukan::find()
                ->joinWith(['refPasukanPenyelidikan'])
                ->joinWith(['refJawatanPasukanPenyelidikan']);

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
            'penyelidikan_komposisi_pasukan_id' => $this->penyelidikan_komposisi_pasukan_id,
            'permohonana_penyelidikan_id' => $this->permohonana_penyelidikan_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'tbl_ref_pasukan_penyelidikan.desc', $this->pasukan])
            ->andFilterWhere(['like', 'tbl_ref_jawatan_pasukan_penyelidikan.desc', $this->jawatan])
            ->andFilterWhere(['like', 'telefon_no', $this->telefon_no])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'institusi_universiti_syarikat', $this->institusi_universiti_syarikat])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
