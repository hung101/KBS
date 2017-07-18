<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GajiDanElaunJurulatih;

/**
 * GajiDanElaunJurulatihSearch represents the model behind the search form about `app\models\GajiDanElaunJurulatih`.
 */
class GajiDanElaunJurulatihSearch extends GajiDanElaunJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaji_dan_elaun_jurulatih_id'], 'integer'],
            [['no_kad_pengenalan', 'nama_jurulatih', 'no_passport', 'nama_sukan', 'tarikh_mula', 'bank', 'no_akaun', 'cawangan', 'catatan'], 'safe'],
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
        $query = GajiDanElaunJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refBank']);

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
            'gaji_dan_elaun_jurulatih_id' => $this->gaji_dan_elaun_jurulatih_id,
            //'nama_jurulatih' => $this->nama_jurulatih,
        ]);

        $query->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
                ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'no_passport', $this->no_passport])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
            ->andFilterWhere(['like', 'tbl_ref_bank.desc', $this->bank])
            ->andFilterWhere(['like', 'no_akaun', $this->no_akaun])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'catatan', $this->catatan]);
        
        // add filter base on view own created data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['gaji-dan-elaun-jurulatih']['view_own_data'])){
            $query->andFilterWhere(['tbl_gaji_dan_elaun_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on view own created data role Jurulatih -> View Own Data - END
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_gaji_dan_elaun_jurulatih.nama_sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $query->andFilterWhere(['tbl_gaji_dan_elaun_jurulatih.nama_sukan'=>$arr_sukan_filter]);
            
            $query->orFilterWhere(['tbl_gaji_dan_elaun_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END

        return $dataProvider;
    }
}
