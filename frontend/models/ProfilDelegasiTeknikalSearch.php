<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilDelegasiTeknikal;

/**
 * ProfilDelegasiTeknikalSearch represents the model behind the search form about `app\models\ProfilDelegasiTeknikal`.
 */
class ProfilDelegasiTeknikalSearch extends ProfilDelegasiTeknikal
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_delegasi_teknikal_id', 'created_by', 'updated_by'], 'integer'],
            [['temasya', 'negeri', 'tarikh_mula', 'tarikh_tamat', 'sukan', 'peringkat', 'nama_badan_sukan', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'created', 'updated'], 'safe'],
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
        $query = ProfilDelegasiTeknikal::find()
                ->joinWith(['refNegeri'])
                 ->joinWith(['refSukan']);

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
            'profil_delegasi_teknikal_id' => $this->profil_delegasi_teknikal_id,
            //'tarikh_mula' => $this->tarikh_mula,
            //'tarikh_tamat' => $this->tarikh_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'temasya', $this->temasya])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'peringkat', $this->peringkat])
            ->andFilterWhere(['like', 'nama_badan_sukan', $this->nama_badan_sukan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'alamat_negeri', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
