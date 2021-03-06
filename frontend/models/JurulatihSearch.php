<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Jurulatih;

/**
 * JurulatihSearch represents the model behind the search form about `app\models\Jurulatih`.
 */
class JurulatihSearch extends Jurulatih
{
    public $sijil;
    public $tahap;
    public $sukan;
    public $program_id;
    public $status_tawaran_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['jurulatih_id', 'bil_tanggungan', 'status_jurulatih', 'status_keaktifan_jurulatih', 'sijil', 'tahap', 'sukan', 
                'program_id', 'status_tawaran_id', 'mesyuarat_id'], 'integer'],
            [['gambar', 'cawangan', 'sub_cawangan_pelapis', 'lain_lain_program', 'pusat_latihan', 'nama_sukan', 'nama_acara', 
                'status_permohonan', 'nama', 'bangsa', 'agama', 'jantina', 'warganegara', 'tarikh_lahir', 'tempat_lahir', 
                'taraf_perkahwinan', 'ic_no', 'ic_no_lama', 'ic_tentera', 'passport_no', 'tamat_tempoh', 'no_visa', 'tamat_visa_tempoh', 'no_permit_kerja', 
                'tamat_permit_tempoh', 'alamat_rumah_1', 'alamat_rumah_2', 'alamat_rumah_3', 'alamat_rumah_negeri', 'alamat_rumah_bandar', 'alamat_rumah_poskod', 
                'alamat_surat_menyurat_1', 'alamat_surat_menyurat_2', 'alamat_surat_menyurat_3', 'alamat_surat_menyurat_negeri', 'alamat_surat_menyurat_bandar', 
                'alamat_surat_menyurat_poskod', 'no_telefon', 'emel', 'status', 'sektor', 'jawatan', 'no_telefon_pejabat', 'nama_majikan', 'alamat_majikan_1', 
                'alamat_majikan_2', 'alamat_majikan_3', 'alamat_majikan_negeri', 'alamat_majikan_bandar', 'alamat_majikan_poskod', 'bahagian', 'program', 'status_tawaran', 'created', 'approved_date', 'status_tawaran_jkb', 'status_tawaran_mpj'], 'safe'],
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
        $query = Jurulatih::find()
                ->joinWith(['refCawangan'])
                ->joinWith(['refSubProgramPelapisJurulatih'])
                ->joinWith(['refSukan'])
                ->joinWith(['refAcara'])
                ->joinWith(['refBahagianJurulatih'])
                ->joinWith(['refProgramJurulatih'])
                ->joinWith(['refJurulatihSpkk'])
                ->joinWith(['refStatusTawaran'])
                ->joinWith(['refJurulatihSukan' => function($query) {
                        $query->orderBy(['tbl_jurulatih_sukan.created' => SORT_DESC])->one();
                    },
                ])
                ->orderBy(['tbl_jurulatih.approved_date' => SORT_DESC])
                ->groupBy(['tbl_jurulatih.jurulatih_id']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        
        // sorting for JKK
        if(isset($this->mesyuarat_id)){
            $query->orderBy(['status_tawaran' => SORT_ASC]);
        }

        $query->andFilterWhere([
            'jurulatih_id' => $this->jurulatih_id,
            'tarikh_lahir' => $this->tarikh_lahir,
            'bil_tanggungan' => $this->bil_tanggungan,
            'tamat_tempoh' => $this->tamat_tempoh,
            'tamat_visa_tempoh' => $this->tamat_visa_tempoh,
            'tamat_permit_tempoh' => $this->tamat_permit_tempoh,
            'status_jurulatih' => $this->status_jurulatih,
            'status_keaktifan_jurulatih' => $this->status_keaktifan_jurulatih,
            'tbl_jurulatih_spkk.jenis_spkk' => $this->sijil,
            'tbl_jurulatih_spkk.tahap' => $this->tahap,
            'nama_sukan' => $this->sukan,
            'program' => $this->program_id,
            'status_tawaran' => $this->status_tawaran_id,
            'tbl_jurulatih_sukan.sukan' => $this->nama_sukan,
            'tbl_jurulatih_sukan.program' => $this->program,
            'mesyuarat_id' => $this->mesyuarat_id,
            'status_tawaran_jkb' => $this->status_tawaran_jkb,
            'status_tawaran_mpj' => $this->status_tawaran_mpj,
        ]);
        
        if($this->ic_no){
            //$this->ic_no = \Yii::$app->encrypter->encrypt($this->ic_no);
        }

        $query->andFilterWhere(['like', 'gambar', $this->gambar])
            ->andFilterWhere(['like', 'tbl_ref_cawangan.desc', $this->cawangan])
            ->andFilterWhere(['like', 'tbl_ref_sub_cawangan_pelapis.desc', $this->sub_cawangan_pelapis])
            ->andFilterWhere(['like', 'lain_lain_program', $this->lain_lain_program])
            ->andFilterWhere(['like', 'pusat_latihan', $this->pusat_latihan])
            //->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tbl_ref_acara.desc', $this->nama_acara])
            //->andFilterWhere(['like', 'status_jurulatih', $this->status_jurulatih])
            ->andFilterWhere(['like', 'status_permohonan', $this->status_permohonan])
            //->andFilterWhere(['like', 'status_keaktifan_jurulatih', $this->status_keaktifan_jurulatih])
            ->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'bangsa', $this->bangsa])
            ->andFilterWhere(['like', 'agama', $this->agama])
            ->andFilterWhere(['like', 'jantina', $this->jantina])
            ->andFilterWhere(['like', 'warganegara', $this->warganegara])
            ->andFilterWhere(['like', 'tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'taraf_perkahwinan', $this->taraf_perkahwinan])
            ->andFilterWhere(['like', 'ic_no', $this->ic_no])
            ->andFilterWhere(['like', 'ic_no_lama', $this->ic_no_lama])
            ->andFilterWhere(['like', 'ic_tentera', $this->ic_tentera])
            ->andFilterWhere(['like', 'passport_no', $this->passport_no])
            ->andFilterWhere(['like', 'no_visa', $this->no_visa])
            ->andFilterWhere(['like', 'no_permit_kerja', $this->no_permit_kerja])
            ->andFilterWhere(['like', 'alamat_rumah_1', $this->alamat_rumah_1])
            ->andFilterWhere(['like', 'alamat_rumah_2', $this->alamat_rumah_2])
            ->andFilterWhere(['like', 'alamat_rumah_3', $this->alamat_rumah_3])
            ->andFilterWhere(['like', 'alamat_rumah_negeri', $this->alamat_rumah_negeri])
            ->andFilterWhere(['like', 'alamat_rumah_bandar', $this->alamat_rumah_bandar])
            ->andFilterWhere(['like', 'alamat_rumah_poskod', $this->alamat_rumah_poskod])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_1', $this->alamat_surat_menyurat_1])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_2', $this->alamat_surat_menyurat_2])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_3', $this->alamat_surat_menyurat_3])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_negeri', $this->alamat_surat_menyurat_negeri])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_bandar', $this->alamat_surat_menyurat_bandar])
            ->andFilterWhere(['like', 'alamat_surat_menyurat_poskod', $this->alamat_surat_menyurat_poskod])
            ->andFilterWhere(['like', 'no_telefon', $this->no_telefon])
            ->andFilterWhere(['like', 'emel', $this->emel])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'sektor', $this->sektor])
            ->andFilterWhere(['like', 'jawatan', $this->jawatan])
            ->andFilterWhere(['like', 'no_telefon_pejabat', $this->no_telefon_pejabat])
            ->andFilterWhere(['like', 'nama_majikan', $this->nama_majikan])
            ->andFilterWhere(['like', 'alamat_majikan_1', $this->alamat_majikan_1])
            ->andFilterWhere(['like', 'alamat_majikan_2', $this->alamat_majikan_2])
            ->andFilterWhere(['like', 'alamat_majikan_3', $this->alamat_majikan_3])
            ->andFilterWhere(['like', 'alamat_majikan_negeri', $this->alamat_majikan_negeri])
            ->andFilterWhere(['like', 'alamat_majikan_bandar', $this->alamat_majikan_bandar])
            ->andFilterWhere(['like', 'alamat_majikan_poskod', $this->alamat_majikan_poskod])
                ->andFilterWhere(['like', 'tbl_jurulatih.created', $this->created])
                ->andFilterWhere(['like', 'tbl_jurulatih.approved_date', $this->approved_date])
                ->andFilterWhere(['like', 'tbl_ref_bahagian_jurulatih.desc', $this->bahagian])
                //->andFilterWhere(['like', 'tbl_ref_program_jurulatih.desc', $this->program])
                ->andFilterWhere(['like', 'tbl_ref_status_tawaran.desc', $this->status_tawaran]);
        
        
        if(Yii::$app->user->identity->peranan ==  10
                || Yii::$app->user->identity->peranan ==  12
                || Yii::$app->user->identity->peranan ==  13
                || Yii::$app->user->identity->peranan ==  33){
           $query->andFilterWhere(['=', 'approved', 1]);
        }
        
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
            
            $query->orFilterWhere(['tbl_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        // add filter base on view own created data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['view_own_data'])){
            $query->andFilterWhere(['tbl_jurulatih.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on view own created data role Jurulatih -> View Own Data - END
        
        // add filter base on view hantar approved data role Jurulatih -> View Own Data - START
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['jurulatih']['kemaskini_yang_hantar'])){
            $query->andFilterWhere(['tbl_jurulatih.approved'=>1]);
        }
        // add filter base on view hantar approved data role Jurulatih -> View Own Data - END

        return $dataProvider;
    }
}
