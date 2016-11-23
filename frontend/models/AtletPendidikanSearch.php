<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AtletPendidikan;
use yii\web\Session;

/**
 * AtletPendidikanSearch represents the model behind the search form about `app\models\AtletPendidikan`.
 */
class AtletPendidikanSearch extends AtletPendidikan
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pendidikan_atlet_id', 'no_telefon', 'created_by', 'updated_by'], 'integer'],
            [['atlet_id', 'jenis_peringkatan_pendidikan', 'kursus', 'fakulti', 'nama', 'alamat_1', 
                'tahun_mula', 'tahun_tamat', 'pelajar_id_no', 'keputusan_cgpa', 'biasiswa_tajaan', 
                'jenis_biasiswa', 'created', 'updated', 'jenis_pencapaian'], 'safe'],
            [['jumlah_biasiswa'], 'number'],
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
        
        $query = AtletPendidikan::find()
                ->joinWith(['tahapPendidikan'])
                ->joinWith(['refJenisPencapaian'])
                ->joinWith(['refNegeri'])
                ->joinWith(['refBandar'])
                ->joinWith(['refSekolahInstitusi']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        /*$dataProvider->setSort([
            'attributes' => [
                'tahapPendidikanDesc' => [
                    'asc' => ['tbl_ref_tahap_pendidikan.desc' => SORT_ASC],
                    'desc' => ['tbl_ref_tahap_pendidikan.desc' => SORT_DESC],
                    'label' => 'Tahap Pendidikan'
                ]
            ]
        ]);*/

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pendidikan_atlet_id' => $this->pendidikan_atlet_id,
            'no_telefon' => $this->no_telefon,
            'tahun_mula' => $this->tahun_mula,
            'tahun_tamat' => $this->tahun_tamat,
            'jumlah_biasiswa' => $this->jumlah_biasiswa,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'atlet_id', $this->atlet_id])
            ->andFilterWhere(['like', 'tbl_ref_tahap_pendidikan.desc', $this->jenis_peringkatan_pendidikan])
            ->andFilterWhere(['like', 'kursus', $this->kursus])
            ->andFilterWhere(['like', 'fakulti', $this->fakulti])
            //->andFilterWhere(['like', 'nama', $this->nama])
                ->andFilterWhere(['like', 'tbl_ref_sekolah_institusi.desc', $this->nama])
            ->andFilterWhere(['like', 'alamat_1', $this->alamat_1])
            ->andFilterWhere(['like', 'pelajar_id_no', $this->pelajar_id_no])
            ->andFilterWhere(['like', 'keputusan_cgpa', $this->keputusan_cgpa])
            ->andFilterWhere(['like', 'biasiswa_tajaan', $this->biasiswa_tajaan])
            ->andFilterWhere(['like', 'jenis_biasiswa', $this->jenis_biasiswa])
                ->andFilterWhere(['like', 'tbl_ref_jenis_pencapaian.desc', $this->jenis_pencapaian]);
        
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
