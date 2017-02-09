<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspElaunLatihanPraktikal */

$this->title = 'Tambah Elaun Latihan Praktikal';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Latihan Praktikal', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-elaun-latihan-praktikal-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
    ]) ?>

</div>
