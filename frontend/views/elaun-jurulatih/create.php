<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ElaunJurulatih */

$this->title = 'Tambah Elaun Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Elaun Jurulatih', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="elaun-jurulatih-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
