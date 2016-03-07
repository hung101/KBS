<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LtbsKejohananProgramAktiviti;

/**
 * LtbsKejohananProgramAktivitiSearch represents the model behind the search form about `app\models\LtbsKejohananProgramAktiviti`.
 */
class LtbsKejohananProgramAktivitiSearch extends LtbsKejohananProgramAktiviti
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['kejohanan_program_aktiviti_id', 'bilangan_peserta_yang_menyertai'], 'integer'],
            [['nama_kejohanana_program_aktiviti_yang_disertai', 'tarikh_kejohanan_program_aktiviti_yang_disertai'], 'safe'],
            [['kos_kejohanan_program_aktiviti_yang_disertai'], 'number'],
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
        $query = LtbsKejohananProgramAktiviti::find();

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
            'kejohanan_program_aktiviti_id' => $this->kejohanan_program_aktiviti_id,
            'tarikh_kejohanan_program_aktiviti_yang_disertai' => $this->tarikh_kejohanan_program_aktiviti_yang_disertai,
            'bilangan_peserta_yang_menyertai' => $this->bilangan_peserta_yang_menyertai,
            'kos_kejohanan_program_aktiviti_yang_disertai' => $this->kos_kejohanan_program_aktiviti_yang_disertai,
        ]);

        $query->andFilterWhere(['like', 'nama_kejohanana_program_aktiviti_yang_disertai', $this->nama_kejohanana_program_aktiviti_yang_disertai]);
        
        // if login as persatuan, then filter only show that persatuan listing
        if(Yii::$app->user->identity->profil_badan_sukan){
            $query->andFilterWhere(['profil_badan_sukan_id' => Yii::$app->user->identity->profil_badan_sukan,]);
        }

        return $dataProvider;
    }
}
