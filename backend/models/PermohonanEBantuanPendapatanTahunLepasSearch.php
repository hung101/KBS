<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanPendapatanTahunLepas;

/**
 * PermohonanEBantuanPendapatanTahunLepasSearch represents the model behind the search form about `app\models\PermohonanEBantuanPendapatanTahunLepas`.
 */
class PermohonanEBantuanPendapatanTahunLepasSearch extends PermohonanEBantuanPendapatanTahunLepas
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pendapatan_tahun_lepas_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['jenis_pendapatan', 'butir_butir', 'session_id'], 'safe'],
            [['jumlah_pendapatan'], 'number'],
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
        $query = PermohonanEBantuanPendapatanTahunLepas::find()
                ->joinWith(['refJenisPendapatan']);

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
            'pendapatan_tahun_lepas_id' => $this->pendapatan_tahun_lepas_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
            'jumlah_pendapatan' => $this->jumlah_pendapatan,
        ]);

        $query->andFilterWhere(['like', 'jenis_pendapatan', $this->jenis_pendapatan])
            ->andFilterWhere(['like', 'butir_butir', $this->butir_butir])
                ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
