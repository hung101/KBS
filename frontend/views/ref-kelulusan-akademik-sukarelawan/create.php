<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKelulusanAkademikSukarelawan */

$this->title = GeneralLabel::createTitle.' '.'Ref Kelulusan Akademik Sukarelawan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Kelulusan Akademik Sukarelawans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kelulusan-akademik-sukarelawan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
