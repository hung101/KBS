<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNamaRehabilitasi */

$this->title = GeneralLabel::createTitle.' '.'Ref Nama Rehabilitasi';
$this->params['breadcrumbs'][] = ['label' => 'Ref Nama Rehabilitasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-nama-rehabilitasi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
