<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MesyuaratSenaraiTugas;

/**
 * MesyuaratSenaraiTugasSearch represents the model behind the search form about `app\models\MesyuaratSenaraiTugas`.
 */
class MesyuaratSenaraiTugasSearch extends MesyuaratSenaraiTugas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_tugas_id', 'mesyuarat_id', 'atlet_id'], 'integer'],
            [['name_tugas', 'tarikh_tamat', 'pegawai', 'persatuan', 'status', 'session_id'], 'safe'],
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
        $query = MesyuaratSenaraiTugas::find()
                ->joinWith(['atlet'])
                ->joinWith(['refMesyuaratSenaraiNamaHadir']);

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
            'senarai_tugas_id' => $this->senarai_tugas_id,
            'tbl_mesyuarat_senarai_tugas.mesyuarat_id' => $this->mesyuarat_id,
            'tarikh_tamat' => $this->tarikh_tamat,
            'atlet_id' => $this->atlet_id,
        ]);

        $query->andFilterWhere(['like', 'name_tugas', $this->name_tugas])
            ->andFilterWhere(['like', 'pegawai', $this->pegawai])
                ->andFilterWhere(['like', 'tbl_mesyuarat_senarai_tugas.session_id', $this->session_id])
            ->andFilterWhere(['like', 'persatuan', $this->persatuan])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
