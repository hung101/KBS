<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RefJawatanBantuanMenghadiriProgramAntarabangsaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Jawatan Bantuan Menghadiri Program Antarabangsas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jawatan-bantuan-menghadiri-program-antarabangsa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ref Jawatan Bantuan Menghadiri Program Antarabangsa', ['create'], ['class' => 'btn btn-success']) ?>
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
