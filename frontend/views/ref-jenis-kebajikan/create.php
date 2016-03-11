<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKebajikan */

$this->title = 'Create Ref Jenis Kebajikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kebajikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kebajikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
