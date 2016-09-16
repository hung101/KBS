<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProfilPusatLatihan;

/**
 * ProfilPusatLatihanSearch represents the model behind the search form about `app\models\ProfilPusatLatihan`.
 */
class ProfilPusatLatihanSearch extends ProfilPusatLatihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profil_pusat_latihan_id', 'created_by', 'updated_by'], 'integer'],
            [['nama_pusat_latihan', 'alamat_1', 'alamat_2', 'alamat_3', 'alamat_negeri', 'alamat_bandar', 'alamat_poskod', 'no_telefon', 'no_faks', 
                'emel', 'tarikh_program_bermula', 'tahun_siap_pembinaan', 'keluasan_venue', 'hakmilik', 'kadar_sewaan', 'status', 'catatan', 'created', 
                'updated', 'sukan', 'program'], 'safe'],
            [['kos_project'], 'number'],
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
        $query = ProfilPusatLatihan::find()
                ->joinWith(['refNegeri'])
                ->joinWith(['refSukan'])
                ->joinWith(['refProgramSemasaSukanAtlet']);

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
            'profil_pusat_latihan_id' => $this->profil_pusat_latihan_id,
            //'tarikh_program_bermula' => $this->tarikh_program_bermula,
            'tahun_siap_pembinaan' => $this->tahun_siap_pembinaan,
            'kos_project' => $this->kos_project,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'nama_pusat_latihan', $this->nama_pusat_latihan])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'alamat_2', $this->alamat_2])
            ->andFilterWhere(['like', 'alamat_3', $this->alamat_3])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->alamat_negeri])
            ->andFilterWhere(['like', 'alamat_bandar', $this->alamat_bandar])
            ->andFilterWhere(['like', 'alamat_poskod', $this->alamat_poskod])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'no_faks', $this->no_faks])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'keluasan_venue', $this->keluasan_venue])
            ->andFilterWhere(['like', 'hakmilik', $this->hakmilik])
            ->andFilterWhere(['like', 'kadar_sewaan', $this->kadar_sewaan])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tarikh_program_bermula', $this->tarikh_program_bermula])
                ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
                ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program]);

        return $dataProvider;
    }
}
