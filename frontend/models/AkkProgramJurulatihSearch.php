<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AkkProgramJurulatih;

/**
 * AkkProgramJurulatihSearch represents the model behind the search form about `app\models\AkkProgramJurulatih`.
 */
class AkkProgramJurulatihSearch extends AkkProgramJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['akk_program_jurulatih_id', 'peningkatan_kerjaya_jurulatih_id'], 'integer'],
            [['nama_program', 'tarikh_program', 'tempat_program', 'kod_kursus', 'tahap'], 'safe'],
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
        $query = AkkProgramJurulatih::find();

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
            'akk_program_jurulatih_id' => $this->akk_program_jurulatih_id,
            'peningkatan_kerjaya_jurulatih_id' => $this->peningkatan_kerjaya_jurulatih_id,
            'tarikh_program' => $this->tarikh_program,
        ]);

        $query->andFilterWhere(['like', 'nama_program', $this->nama_program])
            ->andFilterWhere(['like', 'tempat_program', $this->tempat_program])
            ->andFilterWhere(['like', 'kod_kursus', $this->kod_kursus])
            ->andFilterWhere(['like', 'tahap', $this->tahap]);

        return $dataProvider;
    }
}
