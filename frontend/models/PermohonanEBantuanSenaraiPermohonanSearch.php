<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanSenaraiPermohonan;

/**
 * PermohonanEBantuanSenaraiPermohonanSearch represents the model behind the search form about `app\models\PermohonanEBantuanSenaraiPermohonan`.
 */
class PermohonanEBantuanSenaraiPermohonanSearch extends PermohonanEBantuanSenaraiPermohonan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_permohonan_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['nama_program', 'tahun', 'penghantaran_laporan', 'session_id'], 'safe'],
            [['jumlah_kelulusan'], 'number'],
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
        $query = PermohonanEBantuanSenaraiPermohonan::find();

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
            'senarai_permohonan_id' => $this->senarai_permohonan_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
            'tahun' => $this->tahun,
            'jumlah_kelulusan' => $this->jumlah_kelulusan,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'penghantaran_laporan', $this->penghantaran_laporan])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
