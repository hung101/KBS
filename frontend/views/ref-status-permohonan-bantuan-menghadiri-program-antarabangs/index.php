<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefStatusPermohonanBantuanMenghadiriProgramAntarabangsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Status Permohonan Bantuan Menghadiri Program Antarabangs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-permohonan-bantuan-menghadiri-program-antarabangs-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Status Permohonan Bantuan Menghadiri Program Antarabangs', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'desc',
            'aktif',
            'created_by',
            'updated_by',
            // 'created',
            // 'updated',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
