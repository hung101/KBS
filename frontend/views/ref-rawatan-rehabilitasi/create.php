<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefRawatanRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Rawatan Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Rawatan Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-rawatan-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
