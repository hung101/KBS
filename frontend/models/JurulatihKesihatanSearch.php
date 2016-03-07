<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JurulatihKesihatan;

/**
 * JurulatihKesihatanSearch represents the model behind the search form about `app\models\JurulatihKesihatan`.
 */
class JurulatihKesihatanSearch extends JurulatihKesihatan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_kesihatan_id', 'jurulatih_id'], 'integer'],
            [['tinggi', 'berat'], 'number'],
            [['masalah_kesihatan', 'catatan', 'pembedahan', 'alahan', 'sejarah_perubatan', 'kecacatan'], 'safe'],
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
        $query = JurulatihKesihatan::find()
                ->joinWith(['refMasalahKesihatan']);

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
            'jurulatih_kesihatan_id' => $this->jurulatih_kesihatan_id,
            'jurulatih_id' => $this->jurulatih_id,
            'tinggi' => $this->tinggi,
            'berat' => $this->berat,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_masalah_kesihatan.desc', $this->masalah_kesihatan])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
            ->andFilterWhere(['like', 'pembedahan', $this->pembedahan])
            ->andFilterWhere(['like', 'alahan', $this->alahan])
            ->andFilterWhere(['like', 'sejarah_perubatan', $this->sejarah_perubatan])
            ->andFilterWhere(['like', 'kecacatan', $this->kecacatan]);

        return $dataProvider;
    }
}
