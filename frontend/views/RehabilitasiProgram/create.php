<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RehabilitasiProgram */

$this->title = 'Tambah Rehabilitasi Program';
$this->params['breadcrumbs'][] = ['label' => 'Rehabilitasi Program', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rehabilitasi-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
