<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PembayaranElaunTransaksi;

/**
 * PembayaranElaunTransaksiSearch represents the model behind the search form about `app\models\PembayaranElaunTransaksi`.
 */
class PembayaranElaunTransaksiSearch extends PembayaranElaunTransaksi
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jumlah', 'tarikh_pembayaran', 'session_id', 'created', 'updated'], 'safe'],
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
    public function search($params, $pembayaran_elaun_id)
    {
        if($pembayaran_elaun_id != null)
        {
           $query = PembayaranElaunTransaksi::find()->where(['pembayaran_elaun_id' => $pembayaran_elaun_id]); 
        } else {
            $query = PembayaranElaunTransaksi::find(); 
        }

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
            'pembayaran_elaun_transaksi_id' => $this->pembayaran_elaun_transaksi_id,
            // 'pembayaran_elaun_id' => $this->pembayaran_elaun_id,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tarikh_pembayaran', $this->tarikh_pembayaran])
            ->andFilterWhere(['like', 'session_id', $this->session_id]);

        return $dataProvider;
    }
}
