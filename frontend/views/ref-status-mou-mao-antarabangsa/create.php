<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefStatusMouMaoAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.'Ref Status Mou Mao Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Status Mou Mao Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-status-mou-mao-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
