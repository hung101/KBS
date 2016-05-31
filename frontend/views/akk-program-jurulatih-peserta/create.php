<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AkkProgramJurulatihPeserta */

$this->title = 'Create Akk Program Jurulatih Peserta';
$this->params['breadcrumbs'][] = ['label' => 'Akk Program Jurulatih Pesertas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="akk-program-jurulatih-peserta-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
