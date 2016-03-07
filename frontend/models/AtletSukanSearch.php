<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletSukan;

/**
 * AtletSukanSearch represents the model behind the search form about `app\models\AtletSukan`.
 */
class AtletSukanSearch extends AtletSukan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sukan_id', 'atlet_id'], 'integer'],
            [['nama_sukan', 'acara', 'tahun_umur_permulaan', 'tarikh_mula_menyertai_program_msn', 'program_semasa', 'no_lesen_sukan', 'atlet_persekutuan_dunia_id'], 'safe'],
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
        $query = AtletSukan::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refProgramSemasaSukanAtlet']);

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
            'sukan_id' => $this->sukan_id,
            'atlet_id' => $this->atlet_id,
            'tahun_umur_permulaan' => $this->tahun_umur_permulaan,
            'tarikh_mula_menyertai_program_msn' => $this->tarikh_mula_menyertai_program_msn,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->acara])
            ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program_semasa])
            ->andFilterWhere(['like', 'no_lesen_sukan', $this->no_lesen_sukan])
            ->andFilterWhere(['like', 'atlet_persekutuan_dunia_id', $this->atlet_persekutuan_dunia_id]);

        return $dataProvider;
    }
}
