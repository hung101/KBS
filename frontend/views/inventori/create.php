<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Inventori */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::inventori;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::inventori, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inventori-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelInventoriPeralatan' => $searchModelInventoriPeralatan,
        'dataProviderInventoriPeralatan' => $dataProviderInventoriPeralatan,
        'readonly' => $readonly,
    ]) ?>

</div>
