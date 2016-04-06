<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPermohonanPelanjutan */

$this->title = GeneralLabel::createTitle.' '.'Ref Permohonan Pelanjutan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Permohonan Pelanjutans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-permohonan-pelanjutan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
