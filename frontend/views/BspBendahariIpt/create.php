<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspBendahariIpt */

$this->title = 'Tambah Bendahari IPT';
$this->params['breadcrumbs'][] = ['label' => 'Bendahari IPT', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-bendahari-ipt-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
