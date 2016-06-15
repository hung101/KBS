<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JenisKebajikan;

/**
 * JenisKebajikanSearch represents the model behind the search form about `app\models\JenisKebajikan`.
 */
class JenisKebajikanSearch extends JenisKebajikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jenis_kebajikan_id'], 'integer'],
            [['jenis_kebajikan', 'perkara', 'perkara', 'sukan'], 'safe'],
            [['sukan_sea_para_asean', 'sukan_asia_komenwel_para_asia_ead', 'sukan_olimpik_paralimpik', 'kejohanan_asia_dunia', 'jumlah', 'maksimum', 'peratus'], 'number'],
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
        $query = JenisKebajikan::find()
                ->joinWith(['refJenisKebajikan'])
                ->joinWith(['refPerkara'])
                ->joinWith(['refSukanSkimKebajikan']);

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
            'jenis_kebajikan_id' => $this->jenis_kebajikan_id,
            'sukan_sea_para_asean' => $this->sukan_sea_para_asean,
            'sukan_asia_komenwel_para_asia_ead' => $this->sukan_asia_komenwel_para_asia_ead,
            'sukan_olimpik_paralimpik' => $this->sukan_olimpik_paralimpik,
            'kejohanan_asia_dunia' => $this->kejohanan_asia_dunia,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_kebajikan.desc', $this->jenis_kebajikan])
            ->andFilterWhere(['like', 'tbl_ref_perkara.desc', $this->perkara])
                ->andFilterWhere(['like', 'tbl_ref_sukan_skim_kebajikan.desc', $this->perkara]);

        return $dataProvider;
    }
}
