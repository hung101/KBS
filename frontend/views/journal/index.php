<?php

use yii\helpers\Html;
use yii\grid\GridView;

use app\models\general\GeneralLabel;
use app\models\general\GeneralMessage;
use common\models\general\GeneralFunction;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\JournalSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = GeneralLabel::penerbitan;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="journal-index">
    
    <?php
        $template = '{view}';
        
        // Update Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['journal']['update'])){
            $template .= ' {update}';
        }
        
        // Delete Access
        if(isset(Yii::$app->user->identity->peranan_akses['ISN']['journal']['delete'])){
            $template .= ' {delete}';
        }
    ?>

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if(isset(Yii::$app->user->identity->peranan_akses['ISN']['journal']['create'])): ?>
        <p>
            <?= Html::a(GeneralLabel::createTitle . ' ' . GeneralLabel::penerbitan, ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'journal_id',
            [
                'attribute' => 'nama_penulis',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::nama_penulis,
                ]
            ],
            //'telefon_no',
            //'emel',
            //'alamat_1',
            // 'alamat_2',
            // 'alamat_3',
            // 'alamat_negeri',
            // 'alamat_bandar',
            // 'alamat_poskod',
             [
                'attribute' => 'tarikh_journal',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::tarikh_journal,
                ],
                'value'=>function ($model) {
                    return GeneralFunction::convert($model->tarikh_journal, GeneralFunction::TYPE_DATE);
                },
            ],
            // 'bahagian',
            // 'artikel_journal:ntext',
            //'status_journal',
            [
                'attribute' => 'status_journal',
                'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => GeneralLabel::filter.' '.GeneralLabel::status_journal,
                ],
                'value' => 'refStatusJournal.desc'
            ],

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                        'title' => Yii::t('yii', 'Delete'),
                        'data-confirm' => GeneralMessage::confirmDelete,
                        'data-method' => 'post',
                        ]);

                    },
                ],
                'template' => $template,
            ],
        ],
    ]); ?>

</div>
