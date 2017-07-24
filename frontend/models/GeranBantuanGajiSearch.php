<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\GeranBantuanGaji;

/**
 * GeranBantuanGajiSearch represents the model behind the search form about `app\models\GeranBantuanGaji`.
 */
class GeranBantuanGajiSearch extends GeranBantuanGaji
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['geran_bantuan_gaji_id', 'hantar_flag'], 'integer'],
            [['muatnaik_gambar', 'kelulusan', 'nama_jurulatih', 'cawangan', 'sub_cawangan', 'program_msn', 'lain_lain_program', 'pusat_latihan', 
                'nama_sukan', 'nama_acara', 'status_jurulatih', 'status_permohonan', 'status_keaktifan_jurulatih', 'kategori_geran', 'status_geran', 'catatan'], 'safe'],
            [['jumlah_geran'], 'number'],
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
        $query = GeranBantuanGaji::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refStatusPermohonanGeranBantuanGajiJurulatih'])
                ->joinWith(['refKategoriGeranJurulatih'])
                ->joinWith(['refKelulusan']);

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
            'geran_bantuan_gaji_id' => $this->geran_bantuan_gaji_id,
            'jumlah_geran' => $this->jumlah_geran,
            //'kelulusan' => $this->kelulusan,
            'tbl_geran_bantuan_gaji.hantar_flag' => $this->hantar_flag,
        ]);

        $query->andFilterWhere(['like', 'muatnaik_gambar', $this->muatnaik_gambar])
            ->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih])
            ->andFilterWhere(['like', 'cawangan', $this->cawangan])
            ->andFilterWhere(['like', 'sub_cawangan', $this->sub_cawangan])
            ->andFilterWhere(['like', 'program_msn', $this->program_msn])
            ->andFilterWhere(['like', 'lain_lain_program', $this->lain_lain_program])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan])
            ->andFilterWhere(['like', 'nama_sukan', $this->nama_sukan])
            ->andFilterWhere(['like', 'nama_acara', $this->nama_acara])
            ->andFilterWhere(['like', 'status_jurulatih', $this->status_jurulatih])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_geran_bantuan_gaji_jurulatih.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'status_keaktifan_jurulatih', $this->status_keaktifan_jurulatih])
            ->andFilterWhere(['like', 'tbl_ref_kategori_geran_jurulatih.desc', $this->kategori_geran])
            ->andFilterWhere(['like', 'status_geran', $this->status_geran])
            ->andFilterWhere(['like', 'catatan', $this->catatan])
                ->andFilterWhere(['like', 'tbl_ref_kelulusan_geran_bantuan_gaji_jurulatih.desc', $this->kelulusan]);
        
        
        // add filter base on view own created data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['geran-bantuan-gaji']['view_own_data'])){
            $query->andFilterWhere(['tbl_geran_bantuan_gaji.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on view own created data role Jurulatih -> View Own Data - END
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_geran_bantuan_gaji.nama_sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $query->andFilterWhere(['tbl_geran_bantuan_gaji.nama_sukan'=>$arr_sukan_filter]);
            
            $query->orFilterWhere(['tbl_geran_bantuan_gaji.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END

        return $dataProvider;
    }
}
