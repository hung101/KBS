<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\MaklumatAkademikSubjekSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Maklumat Akademik Subjeks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-akademik-subjek-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Maklumat Akademik Subjek', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'maklumat_akademik_subjek_id',
            'maklumat_akademik_id',
            'session_id',
            'kod_subjek',
            'subjek',
            // 'bil_kredit',
            // 'nama_pensyarah',
            // 'no_telefon',
            // 'email:email',
            // 'created_by',
            // 'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
