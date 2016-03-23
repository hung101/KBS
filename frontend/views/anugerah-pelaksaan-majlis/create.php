<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\AnugerahPelaksaanMajlis */

$this->title = GeneralLabel::createTitle . ' ' . GeneralLabel::anugerah_pelaksaan_majlis;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::anugerah_pelaksaan_majlis, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anugerah-pelaksaan-majlis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
