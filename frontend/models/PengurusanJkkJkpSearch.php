<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJkkJkp;

/**
 * PengurusanJkkJkpSearch represents the model behind the search form about `app\models\PengurusanJkkJkp`.
 */
class PengurusanJkkJkpSearch extends PengurusanJkkJkp
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jkk_jkp_id', 'tempoh_hak_jkk_jkp', 'tempoh_hak', 'status_pilihan'], 'integer'],
            [['nama_setiausaha_jkk_jkp', 'tarikh_pelantikan_jkk_jkp', 'status', 'nama_pegawai_coach', 'jawatan', 'tarikh_pelantikan', 'sukan', 'nama_acara', 'nama_atlet', 'nama_jurulatih', 'jenis_cawangan_kuasa'], 'safe'],
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
        $query = PengurusanJkkJkp::find()
                ->joinWith(['refJenisCawanganKuasaJkkJkp'])
                ->joinWith(['refStatusJkkJkp'])
                ->joinWith(['refNamaAhliJkkJkp']);

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
            'pengurusan_jkk_jkp_id' => $this->pengurusan_jkk_jkp_id,
            //'tarikh_pelantikan_jkk_jkp' => $this->tarikh_pelantikan_jkk_jkp,
            'tempoh_hak_jkk_jkp' => $this->tempoh_hak_jkk_jkp,
            'tarikh_pelantikan' => $this->tarikh_pelantikan,
            'tempoh_hak' => $this->tempoh_hak,
            'status_pilihan' => $this->status_pilihan,
        ]);

        $query->andFilterWhere(['like', 'nama_setiausaha_jkk_jkp', $this->nama_setiausaha_jkk_jkp])
            ->andFilterWhere(['like', 'tbl_ref_status_jkk_jkp.desc', $this->status])
            ->andFilterWhere(['like', 'tbl_ref_jenis_cawangan_kuasa_jkk_jkp.desc', $this->jenis_cawangan_kuasa])
            ->andFilterWhere(['like', 'nama_pegawai_coach', $this->nama_pegawai_coach])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'sukan', $this->sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara])
            ->andFilterWhere(['like', 'nama_atlet', $this->nama_atlet])
            ->andFilterWhere(['like', 'nama_jurulatih', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'tarikh_pelantikan_jkk_jkp', $this->tarikh_pelantikan_jkk_jkp]);

        return $dataProvider;
    }
}
