<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Bsp */

$this->title = 'Pemohonan Biasiswa Sukan Persekutuan';
$this->params['breadcrumbs'][] = ['label' => 'Pemohonan Biasiswa Sukan Persekutuan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bsp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
