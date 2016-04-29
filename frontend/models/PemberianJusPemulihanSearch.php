<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PemberianJusPemulihan;

/**
 * PemberianJusPemulihanSearch represents the model behind the search form about `app\models\PemberianJusPemulihan`.
 */
class PemberianJusPemulihanSearch extends PemberianJusPemulihan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pemberian_jus_pemulihan_id', 'perkhidmatan_permakanan_id', 'sukan', 'acara', 'jenis_jus', 'kuantiti', 'berat_badan', 'created_by', 'updated_by'], 'integer'],
            [['kategori_atlet', 'atlet', 'nama_jus', 'buah', 'session_id', 'created', 'updated'], 'safe'],
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
        $query = PemberianJusPemulihan::find();

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
            'pemberian_jus_pemulihan_id' => $this->pemberian_jus_pemulihan_id,
            'perkhidmatan_permakanan_id' => $this->perkhidmatan_permakanan_id,
            'sukan' => $this->sukan,
            'acara' => $this->acara,
            'jenis_jus' => $this->jenis_jus,
            'kuantiti' => $this->kuantiti,
            'berat_badan' => $this->berat_badan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'kategori_atlet', $this->kategori_atlet])
            ->andFilterWhere(['like', 'atlet', $this->atlet])
            ->andFilterWhere(['like', 'nama_jus', $this->nama_jus])
            ->andFilterWhere(['like', 'buah', $this->buah])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
