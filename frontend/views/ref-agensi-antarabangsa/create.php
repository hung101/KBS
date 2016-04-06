<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefAgensiAntarabangsa */

$this->title = GeneralLabel::createTitle.' '.'Ref Agensi Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Ref Agensi Antarabangsas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-agensi-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
