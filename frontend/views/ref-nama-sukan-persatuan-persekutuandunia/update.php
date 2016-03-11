<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefNamaSukanPersatuanPersekutuandunia */

$this->title = 'Update Ref Nama Sukan Persatuan Persekutuandunia: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Sukan Persatuan Persekutuandunias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-nama-sukan-persatuan-persekutuandunia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
