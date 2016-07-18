<?php

use yii\helpers\Html;

use app\models\general\GeneralLabel;

/* @var $this yii\web\View */
/* @var $model app\models\PertukaranPengajian */

$this->title = GeneralLabel::permohonan;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::pertukaran_pengajian, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pertukaran-pengajian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'readonly' => $readonly,
    ]) ?>

</div>
