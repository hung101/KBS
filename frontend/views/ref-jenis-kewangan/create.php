<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefJenisKewangan */

$this->title = 'Create Ref Jenis Kewangan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Jenis Kewangans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-jenis-kewangan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
