<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TemujanjiKomplimentari;

/**
 * TemujanjiKomplimentariSearch represents the model behind the search form about `app\models\TemujanjiKomplimentari`.
 */
class TemujanjiKomplimentariSearch extends TemujanjiKomplimentari
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['temujanji_komplimentari_id'], 'integer'],
            [['perkhidmatan', 'tarikh_khidmat', 'pegawai_yang_bertanggungjawab', 'status_temujanji', 'catitan_ringkas', 'atlet_id'], 'safe'],
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
        $query = TemujanjiKomplimentari::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refPerkhidmatanKomplimentari'])
                ->joinWith(['refJuruUrut']);

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
            'temujanji_komplimentari_id' => $this->temujanji_komplimentari_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_khidmat' => $this->tarikh_khidmat,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_perkhidmatan_komplimentari.desc', $this->perkhidmatan])
            ->andFilterWhere(['like', 'tbl_ref_juru_urut.desc', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'status_temujanji', $this->status_temujanji])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
