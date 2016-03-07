<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanEBantuanSenaraiSemak;

/**
 * PermohonanEBantuanSenaraiSemakSearch represents the model behind the search form about `app\models\PermohonanEBantuanSenaraiSemak`.
 */
class PermohonanEBantuanSenaraiSemakSearch extends PermohonanEBantuanSenaraiSemak
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['senarai_semak_id', 'permohonan_e_bantuan_id'], 'integer'],
            [['kertas_kerja_projek_program', 'salinan_sijil_pendaftaran_persatuan_pertubuhan', 'salinan_perlembagaan_persatuan_pertubuhan', 'salinan_buku_bank'], 'safe'],
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
        $query = PermohonanEBantuanSenaraiSemak::find();

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
            'senarai_semak_id' => $this->senarai_semak_id,
            'permohonan_e_bantuan_id' => $this->permohonan_e_bantuan_id,
        ]);

        $query->andFilterWhere(['like', 'kertas_kerja_projek_program', $this->kertas_kerja_projek_program])
            ->andFilterWhere(['like', 'salinan_sijil_pendaftaran_persatuan_pertubuhan', $this->salinan_sijil_pendaftaran_persatuan_pertubuhan])
            ->andFilterWhere(['like', 'salinan_perlembagaan_persatuan_pertubuhan', $this->salinan_perlembagaan_persatuan_pertubuhan])
            ->andFilterWhere(['like', 'salinan_buku_bank', $this->salinan_buku_bank]);

        return $dataProvider;
    }
}
