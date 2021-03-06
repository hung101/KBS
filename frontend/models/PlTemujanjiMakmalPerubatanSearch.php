<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PlTemujanjiMakmalPerubatan;

/**
 * PlTemujanjiMakmalPerubatanSearch represents the model behind the search form about `app\models\PlTemujanjiMakmalPerubatan`.
 */
class PlTemujanjiMakmalPerubatanSearch extends PlTemujanjiMakmalPerubatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pl_temujanji_id'], 'integer'],
            [['tarikh_temujanji', 'doktor_pegawai_perubatan', 'makmal_perubatan', 'status_temujanji', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas', 'catatan_tambahan', 'atlet_id'], 'safe'],
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
        $query = PlTemujanjiMakmalPerubatan::find()
                ->joinWith(['refStatusTemujanjiPesakitLuar'])
                ->joinWith(['refPegawaiPerubatan'])
                ->joinWith(['atlet']);

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
            'pl_temujanji_id' => $this->pl_temujanji_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_temujanji' => $this->tarikh_temujanji,
        ]);

        $query->andFilterWhere(['like', 'doktor_pegawai_perubatan', $this->doktor_pegawai_perubatan])
            ->andFilterWhere(['like', 'makmal_perubatan', $this->makmal_perubatan])
            ->andFilterWhere(['like', 'tbl_ref_status_temujanji_pesakit_luar.desc', $this->status_temujanji])
            ->andFilterWhere(['like', 'tbl_ref_pegawai_perubatan.desc', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'catatan_tambahan', $this->catatan_tambahan])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
