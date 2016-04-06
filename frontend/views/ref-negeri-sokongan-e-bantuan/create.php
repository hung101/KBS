<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefNegeriSokonganEBantuan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::negeri_sokongan_ebantuan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::negeri_sokongan_ebantuan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-negeri-sokongan-ebantuan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
