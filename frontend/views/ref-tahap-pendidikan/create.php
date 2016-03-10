<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapPendidikan */

$this->title = 'Create Ref Tahap Pendidikan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Pendidikans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-pendidikan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
