<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\FarmasiPermohonanUbatan;

/**
 * FarmasiPermohonanUbatanSearch represents the model behind the search form about `app\models\FarmasiPermohonanUbatan`.
 */
class FarmasiPermohonanUbatanSearch extends FarmasiPermohonanUbatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['farmasi_permohonan_ubatan_id'], 'integer'],
            [['tarikh_pemberian', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas', 'kelulusan', 'atlet_id'], 'safe'],
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
        $query = FarmasiPermohonanUbatan::find()
                ->joinWith(['refKelulusan']);

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
            'farmasi_permohonan_ubatan_id' => $this->farmasi_permohonan_ubatan_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_pemberian' => $this->tarikh_pemberian,
            //'kelulusan' => $this->kelulusan,
        ]);

        $query->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan.desc', $this->kelulusan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
