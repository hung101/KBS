<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutan */

$this->title = 'Tambah Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Pelanjutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
