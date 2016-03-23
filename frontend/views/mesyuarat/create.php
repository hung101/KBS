<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\Mesyuarat */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::mesyuarat;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::mesyuarat, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mesyuarat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
        'SNHsearchModel' => $SNHsearchModel,
        'SNHdataProvider' => $SNHdataProvider,
        'STsearchModel' => $STsearchModel,
        'STdataProvider' => $STdataProvider,
    ]) ?>

</div>
