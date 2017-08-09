<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PermohonanPeralatan;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;

/**
 * PermohonanPeralatanSearch represents the model behind the search form about `app\models\PermohonanPeralatan`.
 */
class PermohonanPeralatanSearch extends PermohonanPeralatan
{
    public $kelulusan_id;
    public $sukan_id;
    public $program_id;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['permohonan_peralatan_id', 'jumlah_peralatan', 'kelulusan_id', 'mesyuarat_id', 'sukan_id', 'program_id', 'hantar_flag', 'profil_pusat_latihan_id'], 'integer'],
            [['cawangan', 'negeri', 'sukan', 'program', 'tarikh', 'aktiviti', 'nota_urus_setia', 'kelulusan'], 'safe'],
            [['jumlah_diluluskan', 'jumlah_permohonan', 'jumlah_cadangan'], 'number', 'message' => GeneralMessage::yii_validation_number],
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
        $query = PermohonanPeralatan::find()
                ->joinWith(['refProgram'])
                ->joinWith(['refCawangan'])
                ->joinWith(['refNegeri'])
                ->joinWith(['refSukan'])
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
        
        // sorting for JKK
        if(isset($this->mesyuarat_id)){
            $query->orderBy(['kelulusan' => SORT_DESC]);
        }

        $query->andFilterWhere([
            'permohonan_peralatan_id' => $this->permohonan_peralatan_id,
            //'tarikh' => $this->tarikh,
            'jumlah_peralatan' => $this->jumlah_peralatan,
            'kelulusan' => $this->kelulusan_id,
            'mesyuarat_id' => $this->mesyuarat_id,
            'sukan' => $this->sukan_id,
            'program' => $this->program_id,
            'tbl_permohonan_peralatan.hantar_flag' => $this->hantar_flag,
            'profil_pusat_latihan_id' => $this->profil_pusat_latihan_id,
            'tbl_permohonan_peralatan.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'tbl_ref_cawangan.desc', $this->cawangan])
            ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->negeri])
                ->andFilterWhere(['like', 'tarikh', $this->tarikh])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->sukan])
            ->andFilterWhere(['like', 'tbl_ref_program_semasa_sukan_atlet.desc', $this->program])
            ->andFilterWhere(['like', 'aktiviti', $this->aktiviti])
            ->andFilterWhere(['like', 'nota_urus_setia', $this->nota_urus_setia])
            ->andFilterWhere(['like', 'tbl_ref_kelulusan_peralatan.desc', $this->kelulusan])
                ->andFilterWhere(['like', 'jumlah_diluluskan', $this->jumlah_diluluskan])
                ->andFilterWhere(['like', 'jumlah_permohonan', $this->jumlah_permohonan])
                ->andFilterWhere(['like', 'jumlah_cadangan', $this->jumlah_cadangan]);
        
        // add filter base on sukan access role in tbl_user->sukan - START
        if(Yii::$app->user->identity->sukan){
            $sukan_access=explode(',',Yii::$app->user->identity->sukan);
            
            $arr_sukan_filter = array();
            
            for($i = 0; $i < count($sukan_access); $i++){
                $arr_sukan = null;
                $arr_sukan = array('tbl_permohonan_peralatan.sukan'=>$sukan_access[$i]); 
                    array_push($arr_sukan_filter,$arr_sukan);
            }
            
            $query->andFilterWhere(['tbl_permohonan_peralatan.sukan'=>$arr_sukan_filter]);
            
            $query->orFilterWhere(['tbl_permohonan_peralatan.created_by'=>Yii::$app->user->identity->id]);
        }
        // add filter base on sukan access role in tbl_user->sukan - END
        
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['permohonan-peralatan']['kelulusan'])) {
            $query->orFilterWhere(['tbl_permohonan_peralatan.created_by' => Yii::$app->user->identity->id]);
        }

        return $dataProvider;
    }
}
