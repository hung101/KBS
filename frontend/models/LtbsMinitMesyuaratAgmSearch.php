<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsMinitMesyuaratAgm;

/**
 * LtbsMinitMesyuaratAgmSearch represents the model behind the search form about `app\models\LtbsMinitMesyuaratAgm`.
 */
class LtbsMinitMesyuaratAgmSearch extends LtbsMinitMesyuaratAgm
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mesyuarat_agm_id', 'jumlah_ahli_yang_hadir', 'jumlah_ahli_yang_layak_mengundi'], 'integer'],
            [['tarikh', 'masa', 'tempat', 'agenda_mesyuarat', 'keputusan_mesyuarat'], 'safe'],
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
        $query = LtbsMinitMesyuaratAgm::find();

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
            'mesyuarat_agm_id' => $this->mesyuarat_agm_id,
            'tarikh' => $this->tarikh,
            'masa' => $this->masa,
            'jumlah_ahli_yang_hadir' => $this->jumlah_ahli_yang_hadir,
            'jumlah_ahli_yang_layak_mengundi' => $this->jumlah_ahli_yang_layak_mengundi,
        ]);

        $query->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'agenda_mesyuarat', $this->agenda_mesyuarat])
            ->andFilterWhere(['like', 'keputusan_mesyuarat', $this->keputusan_mesyuarat]);

        return $dataProvider;
    }
}
