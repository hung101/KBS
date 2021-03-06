<?php
use app\models\general\GeneralLabel;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefDokumenPengurusanInsurans */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::dokumen;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::dokumen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-dokumen-pengurusan-insurans-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
