<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsMinitMesyuaratJawatankuasa;

/**
 * LtbsMinitMesyuaratJawatankuasaSearch represents the model behind the search form about `app\models\LtbsMinitMesyuaratJawatankuasa`.
 */
class LtbsMinitMesyuaratJawatankuasaSearch extends LtbsMinitMesyuaratJawatankuasa
{
    public $profil_badan_sukan_search;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mesyuarat_id', 'jumlah_ahli_yang_hadir', 'profil_badan_sukan_search'], 'integer'],
            [['tarikh', 'masa', 'tempat', 'mengikut_perlembagaan', 'profil_badan_sukan_id'], 'safe'],
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
        $query = LtbsMinitMesyuaratJawatankuasa::find()
                ->joinWith(['refBadanSukan']);

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
            'mesyuarat_id' => $this->mesyuarat_id,
            //'tarikh' => $this->tarikh,
            'masa' => $this->masa,
            'jumlah_ahli_yang_hadir' => $this->jumlah_ahli_yang_hadir,
            'profil_badan_sukan_id' => $this->profil_badan_sukan_search,
        ]);

        $query->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'mengikut_perlembagaan', $this->mengikut_perlembagaan])
                ->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->profil_badan_sukan_id])
                ->andFilterWhere(['like', 'tarikh', $this->tarikh]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
