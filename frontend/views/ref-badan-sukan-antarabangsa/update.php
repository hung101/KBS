<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RefBadanSukanAntarabangsa */

$this->title = 'Update Ref Badan Sukan Antarabangsa: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Ref Badan Sukan Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ref-badan-sukan-antarabangsa-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
