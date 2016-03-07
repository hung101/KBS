<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AtletPenajaansokongan */

$this->title = 'Penajaan';
//$this->params['breadcrumbs'][] = ['label' => 'Penajaan Sokongan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="atlet-penajaansokongan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
