<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNegeriSokonganEBantuan */

$this->title = GeneralLabel::createTitle.' '.'Ref Negeri Sokongan Ebantuan';
$this->params['breadcrumbs'][] = ['label' => 'Ref Negeri Sokongan Ebantuans', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-negeri-sokongan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
