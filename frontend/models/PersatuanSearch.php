<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persatuan;

/**
 * PersatuanSearch represents the model behind the search form about `app\models\Persatuan`.
 */
class PersatuanSearch extends Persatuan
{
    public $nama_peranan;
    public $ipt_bendahari_e_biasiswa_desc;
    public $urusetia_negeri_e_bantuan_desc;
    public $urusetia_kategori_program_e_bantuan_desc;
    public $profil_badan_sukan_desc;
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'peranan', 'ipt_bendahari_e_biasiswa', 'urusetia_negeri_e_bantuan', 'urusetia_kategori_program_e_bantuan'], 'integer'],
            [['username', 'jabatan_id', 'auth_key', 'password_hash', 'password_reset_token', 'full_name', 'tel_mobile_no', 'tel_no', 'email', 
                'no_kad_pengenalan', 'nama_peranan', 'ipt_bendahari_e_biasiswa_desc', 'urusetia_kategori_program_e_bantuan_desc', 'urusetia_negeri_e_bantuan_desc', 'profil_badan_sukan_desc'], 'safe'],
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
        $query = Persatuan::find()
                ->joinWith(['refJabatanUser'])
                ->joinWith(['refUserPeranan'])
                ->joinWith(['refUniversitiInstitusiEBiasiswa'])
                ->joinWith(['refNegeri'])
                ->joinWith(['refKategoriProgram'])
                ->joinWith(['refProfilBadanSukan']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        
        $dataProvider->sort->attributes['nama_peranan'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_user_peranan.nama_peranan' => SORT_ASC],
            'desc' => ['tbl_user_peranan.nama_peranan' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['ipt_bendahari_e_biasiswa_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_ref_universiti_institusi_e_biasiswa.desc' => SORT_ASC],
            'desc' => ['tbl_ref_universiti_institusi_e_biasiswa.desc' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['urusetia_negeri_e_bantuan_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_ref_negeri.desc' => SORT_ASC],
            'desc' => ['tbl_ref_negeri.desc' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['urusetia_kategori_program_e_bantuan_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_ref_kategori_program.desc' => SORT_ASC],
            'desc' => ['tbl_ref_kategori_program.desc' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['profil_badan_sukan_desc'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['tbl_profil_badan_sukan.nama_badan_sukan' => SORT_ASC],
            'desc' => ['tbl_profil_badan_sukan.nama_badan_sukan' => SORT_DESC],
        ];

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            //'jabatan_id' => $this->jabatan_id,
            'peranan' => $this->peranan,
            'status' => $this->status,
            'ipt_bendahari_e_biasiswa' => $this->ipt_bendahari_e_biasiswa,
            'urusetia_negeri_e_bantuan' => $this->urusetia_negeri_e_bantuan,
            'urusetia_kategori_program_e_bantuan' => $this->urusetia_kategori_program_e_bantuan,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'auth_key', $this->auth_key])
            ->andFilterWhere(['like', 'password_hash', $this->password_hash])
            ->andFilterWhere(['like', 'password_reset_token', $this->password_reset_token])
            ->andFilterWhere(['like', 'full_name', $this->full_name])
            ->andFilterWhere(['like', 'tel_mobile_no', $this->tel_mobile_no])
            ->andFilterWhere(['like', 'tel_no', $this->tel_no])
            ->andFilterWhere(['like', 'email', $this->email])
                ->andFilterWhere(['like', 'tbl_ref_jabatan_user.desc', $this->jabatan_id])
                ->andFilterWhere(['like', 'tbl_user_peranan.nama_peranan', $this->nama_peranan])
                ->andFilterWhere(['like', 'no_kad_pengenalan', $this->no_kad_pengenalan])
                ->andFilterWhere(['like', 'tbl_ref_universiti_institusi_e_biasiswa.desc', $this->ipt_bendahari_e_biasiswa_desc])
                ->andFilterWhere(['like', 'tbl_ref_negeri.desc', $this->urusetia_negeri_e_bantuan_desc])
                ->andFilterWhere(['like', 'tbl_ref_kategori_program.desc', $this->urusetia_kategori_program_e_bantuan_desc])
                ->andFilterWhere(['like', 'tbl_profil_badan_sukan.nama_badan_sukan', $this->profil_badan_sukan_desc]);

        return $dataProvider;
    }
}
