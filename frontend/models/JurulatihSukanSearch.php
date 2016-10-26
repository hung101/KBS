<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihSukan;

/**
 * JurulatihSukanSearch represents the model behind the search form about `app\models\JurulatihSukan`.
 */
class JurulatihSukanSearch extends JurulatihSukan
{
    public $sukan_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_sukan_id', 'jurulatih_id', 'created_by', 'updated_by', 'sukan_id'], 'integer'],
            [['program', 'sukan', 'cawangan', 'bahagian', 'tarikh_mula_lantikan', 'tarikh_tamat_lantikan', 'gaji_elaun', 'created', 'updated'], 'safe'],
            [['jumlah'], 'number'],
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
        $query = JurulatihSukan::find()
                ->joinWith(['refBahagianJurulatih'])
                ->joinWith(['refProgramJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refGajiElaunJurulatih']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'jurulatih_sukan_id' => $this->jurulatih_sukan_id,
            'jurulatih_id' => $this->jurulatih_id,
            //'tarikh_mula_lantikan' => $this->tarikh_mula_lantikan,
            //'tarikh_tamat_lantikan' => $this->tarikh_tamat_lantikan,
            //'jumlah' => $this->jumlah,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
            'sukan' => $this->sukan_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_program_jurulatih.desc', $this->program])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'tbl_ref_bahagian_jurulatih.desc', $this->bahagian])
                ->andFilterWhere(['like', 'jumlah', $this->jumlah])
            ->andFilterWhere(['like', 'tbl_ref_gaji_elaun_jurulatih.desc', $this->gaji_elaun])
                ->andFilterWhere(['like', 'tarikh_mula_lantikan', $this->tarikh_mula_lantikan])
                ->andFilterWhere(['like', 'tarikh_tamat_lantikan', $this->tarikh_tamat_lantikan]);

        return $dataProvider;
    }
}
