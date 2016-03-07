<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PenjadualanUjianFisiologi;

/**
 * PenjadualanUjianFisiologiSearch represents the model behind the search form about `app\models\PenjadualanUjianFisiologi`.
 */
class PenjadualanUjianFisiologiSearch extends PenjadualanUjianFisiologi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['penjadualan_ujian_fisiologi_id'], 'integer'],
            [['perkhidmatan', 'atlet_id', 'tarikh_masa', 'pegawai_yang_bertanggungjawab', 'catitan_ringkas'], 'safe'],
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
        $query = PenjadualanUjianFisiologi::find()
                ->joinWith(['refAtlet'])
                ->joinWith(['refPerkhidmatanFisiologi']);

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
            'penjadualan_ujian_fisiologi_id' => $this->penjadualan_ujian_fisiologi_id,
            //'atlet_id' => $this->atlet_id,
            'tarikh_masa' => $this->tarikh_masa,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_perkhidmatan_fisiologi.desc', $this->perkhidmatan])
            ->andFilterWhere(['like', 'pegawai_yang_bertanggungjawab', $this->pegawai_yang_bertanggungjawab])
            ->andFilterWhere(['like', 'catitan_ringkas', $this->catitan_ringkas])
                ->andFilterWhere(['like', 'tbl_atlet.name_penuh', $this->atlet_id]);

        return $dataProvider;
    }
}
