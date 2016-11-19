<?php

use app\models\general\GeneralLabel;


use yii\helpers\Html;


/* @var $this yii\web\View delete() */
/* @var $model app\models\KemudahPakaianPeralatanTiket Atlet::findOne($id)*/

$this->title = GeneralLabel::kemudahan_pakaianperalatantiket_kapal_terbang;
$this->params['breadcrumbs'][] = ['label' => GeneralLabel::kemudahan_pakaianperalatantiket_kapal_terbang, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kemudah-pakaian-peralatan-tiket-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
