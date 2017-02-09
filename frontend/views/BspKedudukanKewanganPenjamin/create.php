<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspKedudukanKewanganPenjamin */

$this->title = 'Kedudukan Kewangan Penjamin';
$this->params['breadcrumbs'][] = ['label' => 'Kedudukan Kewangan Penjamin', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-kedudukan-kewangan-penjamin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
