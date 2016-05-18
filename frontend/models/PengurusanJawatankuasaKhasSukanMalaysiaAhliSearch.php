<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli;

/**
 * PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch represents the model behind the search form about `app\models\PengurusanJawatankuasaKhasSukanMalaysiaAhli`.
 */
class PengurusanJawatankuasaKhasSukanMalaysiaAhliSearch extends PengurusanJawatankuasaKhasSukanMalaysiaAhli
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id', 'jawatan', 'agensi_organisasi', 'negeri', 'created_by', 'updated_by'], 'integer'],
            [['jenis_keahlian', 'jenis_keahlian_nyatakan', 'nama', 'agensi_organisasi_nyatakan', 'created', 'updated'], 'safe'],
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
        $query = PengurusanJawatankuasaKhasSukanMalaysiaAhli::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id' => $this->pengurusan_jawatankuasa_khas_sukan_malaysia_ahli_id,
            'nama' => $this->nama,
            'jawatan' => $this->jawatan,
            'agensi_organisasi' => $this->agensi_organisasi,
            'negeri' => $this->negeri,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created' => $this->created,
            'updated' => $this->updated,
        ]);

        $query->andFilterWhere(['like', 'jenis_keahlian', $this->jenis_keahlian])
            ->andFilterWhere(['like', 'jenis_keahlian_nyatakan', $this->jenis_keahlian_nyatakan])
            ->andFilterWhere(['like', 'agensi_organisasi_nyatakan', $this->agensi_organisasi_nyatakan]);

        return $dataProvider;
    }
}
