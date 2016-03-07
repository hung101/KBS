<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CadanganElaun */

$this->title = 'Tambah Cadangan Elaun';
$this->params['breadcrumbs'][] = ['label' => 'Cadangan Elaun', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cadangan-elaun-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
