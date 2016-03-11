<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatPengalamanJurulatih */

$this->title = 'Update Ref Peringkat Pengalaman Jurulatih: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Peringkat Pengalaman Jurulatihs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-peringkat-pengalaman-jurulatih-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
