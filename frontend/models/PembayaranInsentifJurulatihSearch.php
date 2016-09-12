<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranInsentifJurulatih;

/**
 * PembayaranInsentifJurulatihSearch represents the model behind the search form about `app\models\PembayaranInsentifJurulatih`.
 */
class PembayaranInsentifJurulatihSearch extends PembayaranInsentifJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembayaran_pembayaran_insentif_jurulatih_id', 'pembayaran_insentif_id', 'created_by', 'updated_by'], 'integer'],
            [['nilai'], 'number'],
            [['session_id', 'created', 'updated', 'nama_jurulatih'], 'safe'],
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
        $query = PembayaranInsentifJurulatih::find()
                ->joinWith(['refJurulatih']);

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
            'pembayaran_pembayaran_insentif_jurulatih_id' => $this->pembayaran_pembayaran_insentif_jurulatih_id,
            'pembayaran_insentif_id' => $this->pembayaran_insentif_id,
            //'nama_jurulatih' => $this->nama_jurulatih,
            'nilai' => $this->nilai,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih]);

        return $dataProvider;
    }
}
