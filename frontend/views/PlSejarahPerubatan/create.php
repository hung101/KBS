<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PlSejarahPerubatan */

$this->title = GeneralLabel::tambah_sejarah_perubatan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::sejarah_perubatan, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pl-sejarah-perubatan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
