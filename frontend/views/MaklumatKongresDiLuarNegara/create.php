<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MaklumatKongresDiLuarNegara */

$this->title = 'Tambah Maklumat Kongres Di Luar Negara';
$this->params['breadcrumbs'][] = ['label' => 'Maklumat Kongres Di Luar Negara', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="maklumat-kongres-di-luar-negara-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
