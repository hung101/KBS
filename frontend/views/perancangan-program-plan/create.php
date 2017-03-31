<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PerancanganProgramPlan */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::pelan_periodisasi;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pelan_periodisasi, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perancangan-program-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
		'searchModelPerancanganProgramPlanItem' => $searchModelPerancanganProgramPlanItem,
        'dataProviderPerancanganProgramPlanItem' => $dataProviderPerancanganProgramPlanItem,
    ]) ?>

</div>
