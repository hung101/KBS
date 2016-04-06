<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefTahapKelayakanJurulatih */

$this->title = GeneralLabel::createTitle.' '.'Ref Tahap Kelayakan Jurulatih';
$this->params['breadcrumbs'][] = ['label' => 'Ref Tahap Kelayakan Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-kelayakan-jurulatih-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
