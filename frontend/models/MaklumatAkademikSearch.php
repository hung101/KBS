<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MaklumatAkademik;

/**
 * MaklumatAkademikSearch represents the model behind the search form about `app\models\MaklumatAkademik`.
 */
class MaklumatAkademikSearch extends MaklumatAkademik
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['maklumat_akademik_id', 'atlet', 'sukan', 'program', 'jumlah_semester', 'jumlah_tahun', 'tahun_kemasukan', 'created_by', 'updated_by'], 'integer'],
            [['no_matrik', 'fakulti', 'atlet_no_tel', 'atlet_hp_no', 'penasihat_akademik', 'penasihat_no_tel', 'penasihat_hp_no', 'semester', 'created', 'updated'], 'safe'],
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
        $query = MaklumatAkademik::find()->joinWith(['refAtlet', 'refSukan', 'refProgramSemasaSukanAtlet']);

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
            'maklumat_akademik_id' => $this->maklumat_akademik_id,
            'atlet' => $this->atlet,
            'sukan' => $this->sukan,
            'program' => $this->program,
            'jumlah_semester' => $this->jumlah_semester,
            'jumlah_tahun' => $this->jumlah_tahun,
            'tahun_kemasukan' => $this->tahun_kemasukan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'no_matrik', $this->no_matrik])
            ->andFilterWhere(['like', 'fakulti', $this->fakulti])
            ->andFilterWhere(['like', 'atlet_no_tel', $this->atlet_no_tel])
            ->andFilterWhere(['like', 'atlet_hp_no', $this->atlet_hp_no])
            ->andFilterWhere(['like', 'penasihat_akademik', $this->penasihat_akademik])
            ->andFilterWhere(['like', 'penasihat_no_tel', $this->penasihat_no_tel])
            ->andFilterWhere(['like', 'penasihat_hp_no', $this->penasihat_hp_no])
            ->andFilterWhere(['like', 'semester', $this->semester]);

        return $dataProvider;
    }
}
