<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PermohonanEBantuanObjektifPertubuhan */

$this->title = 'Tambah Objektif Pertubuhan';
$this->params['breadcrumbs'][] = ['label' => 'Objektif Pertubuhan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="permohonan-ebantuan-objektif-pertubuhan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
