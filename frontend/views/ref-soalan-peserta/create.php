<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefSoalanPeserta */

$this->title = 'Create Ref Soalan Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Ref Soalan Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-soalan-peserta-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
