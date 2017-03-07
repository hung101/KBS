<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranInsentifPersatuan;

/**
 * PembayaranInsentifPersatuanSearch represents the model behind the search form about `app\models\PembayaranInsentifPersatuan`.
 */
class PembayaranInsentifPersatuanSearch extends PembayaranInsentifPersatuan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pembayaran_insentif_persatuan_id', 'pembayaran_insentif_id', 'persatuan', 'nama_bank', 'no_akaun_bank', 'created_by', 'updated_by'], 'integer'],
            [['nilai'], 'number'],
            [['session_id', 'created', 'updated'], 'safe'],
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
        $query = PembayaranInsentifPersatuan::find();

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
            'pembayaran_insentif_persatuan_id' => $this->pembayaran_insentif_persatuan_id,
            'pembayaran_insentif_id' => $this->pembayaran_insentif_id,
            'persatuan' => $this->persatuan,
            'nama_bank' => $this->nama_bank,
            'no_akaun_bank' => $this->no_akaun_bank,
            'nilai' => $this->nilai,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
