<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PengurusanJaringanAntarabangsa */

$this->title =  GeneralLabel::createTitle . ' Pengurusan Jaringan Antarabangsa';
$this->params['breadcrumbs'][] = ['label' => 'Pengurusan Jaringan Antarabangsa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengurusan-jaringan-antarabangsa-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'searchModelKelayakan' => $searchModelKelayakan,
        'dataProviderKelayakan' => $dataProviderKelayakan,
        'readonly' => $readonly,
    ]) ?>

</div>
