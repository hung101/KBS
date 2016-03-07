<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\BspKedudukanKewanganPenjamin;

/**
 * BspKedudukanKewanganPenjaminSearch represents the model behind the search form about `app\models\BspKedudukanKewanganPenjamin`.
 */
class BspKedudukanKewanganPenjaminSearch extends BspKedudukanKewanganPenjamin
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['bsp_kedudukan_kewangan_penjamin_id', 'bsp_penjamin_id', 'jumlah_anak'], 'integer'],
            [['pendapatan_bulanan', 'pinjaman_perumahan_baki_terkini', 'sebagai_penjamin_siberhutang', 'lain_lain_pinjaman_tanggungan'], 'number'],
            [['perkerjaan', 'nama_alamat_majikan', 'nama_isteri_suami', 'no_kp_isteri_suami', 'pertalian_keluarga_dengan_pelajar', 'pelajar_lain_selain_daripada_penerima_di_atas'], 'safe'],
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
        $query = BspKedudukanKewanganPenjamin::find();

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
            'bsp_kedudukan_kewangan_penjamin_id' => $this->bsp_kedudukan_kewangan_penjamin_id,
            'bsp_penjamin_id' => $this->bsp_penjamin_id,
            'pendapatan_bulanan' => $this->pendapatan_bulanan,
            'pinjaman_perumahan_baki_terkini' => $this->pinjaman_perumahan_baki_terkini,
            'sebagai_penjamin_siberhutang' => $this->sebagai_penjamin_siberhutang,
            'lain_lain_pinjaman_tanggungan' => $this->lain_lain_pinjaman_tanggungan,
            'jumlah_anak' => $this->jumlah_anak,
        ]);

        $query->andFilterWhere(['like', 'perkerjaan', $this->perkerjaan])
            ->andFilterWhere(['like', 'nama_alamat_majikan', $this->nama_alamat_majikan])
            ->andFilterWhere(['like', 'nama_isteri_suami', $this->nama_isteri_suami])
            ->andFilterWhere(['like', 'no_kp_isteri_suami', $this->no_kp_isteri_suami])
            ->andFilterWhere(['like', 'pertalian_keluarga_dengan_pelajar', $this->pertalian_keluarga_dengan_pelajar])
            ->andFilterWhere(['like', 'pelajar_lain_selain_daripada_penerima_di_atas', $this->pelajar_lain_selain_daripada_penerima_di_atas]);

        return $dataProvider;
    }
}
