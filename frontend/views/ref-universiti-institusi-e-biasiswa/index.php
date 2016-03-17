<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefUniversitiInstitusiEBiasiswaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Universiti Institusi Ebiasiswas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-universiti-institusi-ebiasiswa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Universiti Institusi Ebiasiswa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'ref_universiti_institusi_kategori_e_biasiswa_id',
                'value' => 'refUniversitiInstitusiKategoriEBiasiswa.desc',
            ],
            'desc',
            // 'aktif',
            [
                'attribute' => 'aktif',
                'value' => function ($model) {
                    return $model->aktif == 1 ? GeneralLabel::yes : GeneralLabel::no;
                },
            ],
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
