<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanCadanganKertasKerja;

/**
 * PermohonanEBantuanCadanganKertasKerjaSearch represents the model behind the search form about `app\models\PermohonanEBantuanCadanganKertasKerja`.
 */
class PermohonanEBantuanCadanganKertasKerjaSearch extends PermohonanEBantuanCadanganKertasKerja
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_e_bantuan_cadangan_kertas_kerja_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['nama_cadangan_kertas_kerja', 'muat_naik'], 'safe'],
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
        $query = PermohonanEBantuanCadanganKertasKerja::find();

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
            'permohonan_e_bantuan_cadangan_kertas_kerja_id' => $this->permohonan_e_bantuan_cadangan_kertas_kerja_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_cadangan_kertas_kerja', $this->nama_cadangan_kertas_kerja])
            ->andFilterWhere(['like', 'muat_naik', $this->muat_naik]);

        return $dataProvider;
    }
}
