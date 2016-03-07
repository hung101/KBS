<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LatihanDanProgramPeserta;

/**
 * LatihanDanProgramPesertaSearch represents the model behind the search form about `app\models\LatihanDanProgramPeserta`.
 */
class LatihanDanProgramPesertaSearch extends LatihanDanProgramPeserta
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['latihan_dan_program_peserta_id', 'latihan_dan_program_id'], 'integer'],
            [['nama', 'no_kad_pengenalan', 'nama_badan_sukan', 'no_pendaftaran_sukan', 'jawatan', 'tempoh_memegang_jawatan', 'no_tel_bimbit', 'emel', 'session_id'], 'safe'],
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
        $query = LatihanDanProgramPeserta::find()
                ->joinWith(['refBadanSukan']);

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
            'latihan_dan_program_peserta_id' => $this->latihan_dan_program_peserta_id,
            'latihan_dan_program_id' => $this->latihan_dan_program_id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
            ->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->nama_badan_sukan])
            ->andFilterWhere(['like', 'no_pendaftaran_sukan', $this->no_pendaftaran_sukan])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'tempoh_memegang_jawatan', $this->tempoh_memegang_jawatan])
            ->andFilterWhere(['like', 'no_tel_bimbit', $this->no_tel_bimbit])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
