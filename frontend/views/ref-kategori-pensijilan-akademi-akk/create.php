<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RefKategoriPensijilanAkademiAkk */

$this->title = GeneralLabel::createTitle.' '.GeneralLabel::kategori_pensijilan_akademi_akk;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kategori_pensijilan_akademi_akk, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-kategori-pensijilan-akademi-akk-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
