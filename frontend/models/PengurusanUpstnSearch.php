<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanUpstn;

/**
 * PengurusanUpstnSearch represents the model behind the search form about `app\models\PengurusanUpstn`.
 */
class PengurusanUpstnSearch extends PengurusanUpstn
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_upstn_id', 'created_by', 'hantar_flag'], 'integer'],
            [['nama_pengurus_sukan', 'nama_sukan', 'tarikh_lawatan', 'masa', 'tempat', 'kehadiran', 'isu', 'ulasan'], 'safe'],
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
        $query = PengurusanUpstn::find()
                ->joinWith(['refSukan'])
                ->joinWith(['refPpn']);

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
            'pengurusan_upstn_id' => $this->pengurusan_upstn_id,
            //'tarikh_lawatan' => $this->tarikh_lawatan,
            'masa' => $this->masa,
            'tbl_pengurusan_upstn.created_by' => $this->created_by,
            'tbl_pengurusan_upstn.hantar_flag' => $this->hantar_flag,
        ]);

        $query//->andFilterWhere(['like', 'nama_pengurus_sukan', $this->nama_pengurus_sukan])
                ->andFilterWhere(['like', 'tbl_user.full_name', $this->nama_pengurus_sukan])
            ->andFilterWhere(['like', 'tbl_ref_sukan.desc', $this->nama_sukan])
            ->andFilterWhere(['like', 'tempat', $this->tempat])
            ->andFilterWhere(['like', 'kehadiran', $this->kehadiran])
            ->andFilterWhere(['like', 'isu', $this->isu])
            ->andFilterWhere(['like', 'ulasan', $this->ulasan])
                ->andFilterWhere(['like', 'tarikh_lawatan', $this->tarikh_lawatan]);
        
        if(isset(Yii::$app->user->identity->peranan_akses['MSN']['pengurusan-upstn']['kelulusan'])) {
            $query->orFilterWhere(['tbl_pengurusan_upstn.created_by' => Yii::$app->user->identity->id]);
        }

        return $dataProvider;
    }
}
