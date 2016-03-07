<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletAset;
use yii\web\Session;

/**
 * AtletAsetSearch represents the model behind the search form about `app\models\AtletAset`.
 */
class AtletAsetSearch extends AtletAset
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['aset_id', 'atlet_id', 'created_by', 'updated_by'], 'integer'],
            [['jenis_aset', 'daftar_no_pengangkutan', 'jenis_harta_pengangkutan_perniagaan', 'daftar_alamat_1', 'nama_syarikat_perniagaan', 'produk_perkhidmatan_perniagaan', 'created', 'updated'], 'safe'],
            [['nilai_harta_pengangkutan'], 'number'],
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
        $query = AtletAset::find()
                ->joinWith(['jenisAset'])
                ->joinWith(['jenisAsetSub']);

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
            'aset_id' => $this->aset_id,
            'atlet_id' => $this->atlet_id,
            'nilai_harta_pengangkutan' => $this->nilai_harta_pengangkutan,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_jenis_aset.desc', $this->jenis_aset])
                ->andFilterWhere(['like', 'tbl_ref_jenis_aset_sub.desc', $this->jenis_harta_pengangkutan_perniagaan])
            ->andFilterWhere(['like', 'daftar_no_pengangkutan', $this->daftar_no_pengangkutan])
            ->andFilterWhere(['like', 'daftar_alamat_1', $this->daftar_alamat_1])
            ->andFilterWhere(['like', 'nama_syarikat_perniagaan', $this->nama_syarikat_perniagaan])
            ->andFilterWhere(['like', 'produk_perkhidmatan_perniagaan', $this->produk_perkhidmatan_perniagaan]);
        
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
