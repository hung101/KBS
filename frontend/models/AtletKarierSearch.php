<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletKarier;
use yii\web\Session;

/**
 * AtletKarierSearch represents the model behind the search form about `app\models\AtletKarier`.
 */
class AtletKarierSearch extends AtletKarier
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['karier_atlet_id', 'tel_no', 'created_by', 'updated_by'], 'integer'],
            [['atlet_id', 'syarikat', 'alamat_1', 'laman_web', 'emel', 'jawatan_kerja', 'tahun_mula', 'tahun_tamat', 'socso_no', 'kwsp_no', 'income_tax_no', 'created', 'updated'], 'safe'],
            [['pendapatan'], 'number'],
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
        $query = AtletKarier::find();

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
            'karier_atlet_id' => $this->karier_atlet_id,
            'tel_no' => $this->tel_no,
            'pendapatan' => $this->pendapatan,
            'tahun_mula' => $this->tahun_mula,
            'tahun_tamat' => $this->tahun_tamat,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'atlet_id', $this->atlet_id])
            ->andFilterWhere(['like', 'syarikat', $this->syarikat])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'laman_web', $this->laman_web])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'jawatan_kerja', $this->jawatan_kerja])
            ->andFilterWhere(['like', 'socso_no', $this->socso_no])
            ->andFilterWhere(['like', 'kwsp_no', $this->kwsp_no])
            ->andFilterWhere(['like', 'income_tax_no', $this->income_tax_no]);
        
        // Filter by atlet id
        $session = new Session;
        $session->open();

        if(isset($session['atlet_id'])){
            $atlet_id = $session['atlet_id'];

            $query->andFilterWhere([
                'atlet_id' => $atlet_id,
            ]);
        }
        
        $session->close();

        return $dataProvider;
    }
}
