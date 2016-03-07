<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SenaraiJurulatih */

$this->title = 'Update Senarai Jurulatih: ' . ' ' . $model->senarai_jurulatih_id;
$this->params['breadcrumbs'][] = ['label' => 'Senarai Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->senarai_jurulatih_id, 'url' => ['view', 'id' => $model->senarai_jurulatih_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="senarai-jurulatih-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
