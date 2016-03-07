<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\MesyuaratSenaraiNamaHadir */

$this->title = 'Nama Ahli';
$this->params['breadcrumbs'][] = ['label' => 'Senarai Nama Ahli', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-senarai-nama-hadir-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
