<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;
/* @var $this yii\web\View */
/* @var $model app\models\RefTahapAkademik */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::tahap_akademik;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::tahap_akademik, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-tahap-akademik-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
