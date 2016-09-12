<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJawatankuasaKhasSukanMalaysia;

/**
 * PengurusanJawatankuasaKhasSukanMalaysiaSearch represents the model behind the search form about `app\models\PengurusanJawatankuasaKhasSukanMalaysia`.
 */
class PengurusanJawatankuasaKhasSukanMalaysiaSearch extends PengurusanJawatankuasaKhasSukanMalaysia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jawatankuasa_khas_sukan_malaysia_id', 'created_by', 'updated_by'], 'integer'],
            [['temasya', 'tarikh_mula', 'tarikh_tamat', 'created', 'updated', 'jawatankuasa'], 'safe'],
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
        $query = PengurusanJawatankuasaKhasSukanMalaysia::find()
                ->joinWith(['refJawatankuasaKhas']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pengurusan_jawatankuasa_khas_sukan_malaysia_id' => $this->pengurusan_jawatankuasa_khas_sukan_malaysia_id,
            //'tarikh_mula' => $this->tarikh_mula,
            //'tarikh_tamat' => $this->tarikh_tamat,
            //'jawatankuasa' => $this->jawatankuasa,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'temasya', $this->temasya])
                ->andFilterWhere(['like', 'tbl_ref_jawatankuasa_khas.desc', $this->jawatankuasa])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat]);

        return $dataProvider;
    }
}
