<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih;

/**
 * PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch represents the model behind the search form about `app\models\PengurusanPenyambunganDanPenamatanKontrakJurulatih`.
 */
class PengurusanPenyambunganDanPenamatanKontrakJurulatihSearch extends PengurusanPenyambunganDanPenamatanKontrakJurulatih
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id'], 'integer'],
            [['jurulatih', 'status_permohonan', 'muat_naik_document', 'tarikh_mula', 'tarikh_tamat','status_tawaran_jkb','status_tawaran_mpj'], 'safe'],
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
        $query = PengurusanPenyambunganDanPenamatanKontrakJurulatih::find()
                ->joinWith(['refJurulatih'])
                ->joinWith(['refStatusPermohonanKontrakJurulatih'])
                ->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
                ]);

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
            'pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id' => $this->pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih_id,
        ]);

        $query->andFilterWhere(['like', 'tbl_jurulatih.nama', $this->jurulatih])
                ->andFilterWhere(['like', 'tarikh_mula', $this->tarikh_mula])
                ->andFilterWhere(['like', 'tarikh_tamat', $this->tarikh_tamat])
            ->andFilterWhere(['like', 'tbl_ref_status_permohonan_kontrak_jurulatih.desc', $this->status_permohonan])
            ->andFilterWhere(['like', 'muat_naik_document', $this->muat_naik_document])
                ->andFilterWhere(['like', 'st1.desc', $this->status_tawaran_jkb])
            ->andFilterWhere(['like', 'st2.desc', $this->status_tawaran_mpj]);
        
        
        // add filter base on view own created data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-penyambungan-dan-penamatan-kontrak-jurulatih']['view_own_data'])){
            $query->andFilterWhere(['tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on view own created data role Jurulatih -> View Own Data - END
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_jurulatih_sukan.sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $query->andFilterWhere(['tbl_jurulatih_sukan.sukan'=>$arr_sukan_filter]);
            
            $query->orFilterWhere(['tbl_pengurusan_penyambungan_dan_penamatan_kontrak_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END

        return $dataProvider;
    }
}
