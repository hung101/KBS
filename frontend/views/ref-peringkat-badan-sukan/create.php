<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeringkatBadanSukan */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peringkat_badan_sukan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peringkat_badan_sukan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peringkat-badan-sukan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
