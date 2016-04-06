<?php

use app\models\general\GeneralLabel;

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefPeralatanPinjaman */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::peralatan_pinjaman;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::peralatan_pinjamen, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-peralatan-pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
