<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPemantauanDanPenilaianJurulatih;

/**
 * PengurusanPemantauanDanPenilaianJurulatihSearch represents the model behind the search form about `app\models\PengurusanPemantauanDanPenilaianJurulatih`.
 */
class PengurusanPemantauanDanPenilaianJurulatihSearch extends PengurusanPemantauanDanPenilaianJurulatih
{
    public $jurulatih;
    public $jurulatih_id_filter;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_pemantauan_dan_penilaian_jurulatih_id', 'jurulatih', 'hantar'], 'integer'],
            [['nama_jurulatih_dinilai', 'nama_sukan', 'nama_acara', 'pusat_latihan'], 'safe'],
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
        $query = PengurusanPemantauanDanPenilaianJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara']);

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
            'pengurusan_pemantauan_dan_penilaian_jurulatih_id' => $this->pengurusan_pemantauan_dan_penilaian_jurulatih_id,
            'nama_jurulatih_dinilai' => $this->jurulatih,
            'hantar' => $this->hantar,
        ]);

        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->nama_jurulatih_dinilai])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan]);
        
        // add filter base on view own created data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-pemantauan-dan-penilaian-jurulatih']['view_own_data'])){
            $query->andFilterWhere(['tbl_pengurusan_pemantauan_dan_penilaian_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on view own created data role Jurulatih -> View Own Data - END
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_pengurusan_pemantauan_dan_penilaian_jurulatih.nama_sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $query->andFilterWhere(['tbl_pengurusan_pemantauan_dan_penilaian_jurulatih.nama_sukan'=>$arr_sukan_filter]);
            
            $query->orFilterWhere(['tbl_pengurusan_pemantauan_dan_penilaian_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END

        return $dataProvider;
    }
}
