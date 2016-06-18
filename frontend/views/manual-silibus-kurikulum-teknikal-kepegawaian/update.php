<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ManualSilibusKurikulumTeknikalKepegawaian */

$this->title = 'Update Manual Silibus Kurikulum Teknikal Kepegawaian: ' . $model->manual_silibus_kurikulum_teknikal_kepegawaian_id;
$this->params['breadcrumbs'][] = ['label' => 'Manual Silibus Kurikulum Teknikal Kepegawaians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id, 'url' => ['view', 'id' => $model->manual_silibus_kurikulum_teknikal_kepegawaian_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="manual-silibus-kurikulum-teknikal-kepegawaian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
