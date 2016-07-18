<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsAhliGabungan;

/**
 * LtbsAhliGabunganSearch represents the model behind the search form about `app\models\LtbsAhliGabungan`.
 */
class LtbsAhliGabunganSearch extends LtbsAhliGabungan
{
    public $badan_sukan;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ahli_gabungan_id', 'profil_badan_sukan_id'], 'integer'],
            [['nama_badan_sukan', 'alamat_badan_sukan_1', 'nama_penuh_presiden_badan_sukan', 'nama_penuh_setiausaha_badan_sukan', 'badan_sukan', 'nama', 'status'], 'safe'],
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
        $query = LtbsAhliGabungan::find()
                ->joinWith(['refBadanSukan'])
                ->joinWith(['refStatusLaporanMesyuaratAgung']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        /**
        * Setup your sorting attributes
        * Note: This is setup before the $this->load($params) 
        * statement below
        */
        /*$dataProvider->setSort([
           'attributes' => [
               'badan_sukan' => [
                   'asc' => ['tbl_profil_badan_sukan.nama_badan_sukan' => SORT_ASC],
                   'desc' => ['tbl_profil_badan_sukan.nama_badan_sukan' => SORT_DESC],
                   'label' => 'Badan Sukan',
                   'default' => SORT_ASC
               ],
               'alamat_badan_sukan_1' => [
                   'asc' => ['alamat_badan_sukan_1' => SORT_ASC],
                   'desc' => ['alamat_badan_sukan_1' => SORT_DESC],
                   'label' => 'Alamat Badan Sukan',
                   'default' => SORT_ASC
               ],
           ]
       ]);*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'ahli_gabungan_id' => $this->ahli_gabungan_id,
            'profil_badan_sukan_id' => $this->profil_badan_sukan_id,
        ]);

        $query->andFilterWhere(['like', 'nama_badan_sukan', $this->nama_badan_sukan])
                ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'alamat_badan_sukan_1', $this->alamat_badan_sukan_1])
            ->andFilterWhere(['like', 'nama_penuh_presiden_badan_sukan', $this->nama_penuh_presiden_badan_sukan])
            ->andFilterWhere(['like', 'nama_penuh_setiausaha_badan_sukan', $this->nama_penuh_setiausaha_badan_sukan])
                ->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->badan_sukan])
                ->andFilterWhere(['like', 'tbl_ref_status_laporan_mesyuarat_agung.desc', $this->status]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
