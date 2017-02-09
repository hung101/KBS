<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BspPerlanjutanSebab */

$this->title = 'Tambah Sebab Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Sebab Pelanjutan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-perlanjutan-sebab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
