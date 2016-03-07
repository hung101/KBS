<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanSenaraiAktivitiProjek;

/**
 * PermohonanEBantuanSenaraiAktivitiProjekSearch represents the model behind the search form about `app\models\PermohonanEBantuanSenaraiAktivitiProjek`.
 */
class PermohonanEBantuanSenaraiAktivitiProjekSearch extends PermohonanEBantuanSenaraiAktivitiProjek
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_aktiviti_projek_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['nama_aktiviti_projek', 'keterangan_ringkas', 'kejayaan_yang_dicapai'], 'safe'],
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
        $query = PermohonanEBantuanSenaraiAktivitiProjek::find();

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
            'senarai_aktiviti_projek_id' => $this->senarai_aktiviti_projek_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_aktiviti_projek', $this->nama_aktiviti_projek])
            ->andFilterWhere(['like', 'keterangan_ringkas', $this->keterangan_ringkas])
            ->andFilterWhere(['like', 'kejayaan_yang_dicapai', $this->kejayaan_yang_dicapai]);

        return $dataProvider;
    }
}
