<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peralatan */

$this->title = 'Tambah Peralatan';
$this->params['breadcrumbs'][] = ['label' => 'Peralatan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peralatan-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
