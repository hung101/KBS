<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPerubatanSejarah;
use yii\web\Session;

/**
 * AtletPerubatanSejarahSearch represents the model behind the search form about `app\models\AtletPerubatanSejarah`.
 */
class AtletPerubatanSejarahSearch extends AtletPerubatanSejarah
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sejarah_perubatan_id', 'atlet_id'], 'integer'],
            [['jenis', 'jenis_sejarah_perubatan', 'bila', 'mana', 'bagaimana', 'siapa_yang_merawat'], 'safe'],
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
        $query = AtletPerubatanSejarah::find()
                ->joinWith(['jenisPenyakit'])
                ->joinWith(['jenisSejarahPerubatan']);

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
            'sejarah_perubatan_id' => $this->sejarah_perubatan_id,
            'atlet_id' => $this->atlet_id,
            'bila' => $this->bila,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_penyakit.desc', $this->jenis])
                //->andFilterWhere(['like', 'jenis', $this->jenis])
                ->andFilterWhere(['like', 'tbl_ref_jenis_sejarah_perubatan.desc', $this->jenis_sejarah_perubatan])
            //->andFilterWhere(['like', 'jenis_sejarah_perubatan', $this->jenis_sejarah_perubatan])
            ->andFilterWhere(['like', 'mana', $this->mana])
            ->andFilterWhere(['like', 'bagaimana', $this->bagaimana])
            ->andFilterWhere(['like', 'siapa_yang_merawat', $this->siapa_yang_merawat]);
        
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
