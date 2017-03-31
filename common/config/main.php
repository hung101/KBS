<?php
use \kartik\datecontrol\Module;

return [
    'name'=>'SPSB',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'defaultTimeZone' => 'Asia/Kuala_Lumpur',
			'nullDisplay' => '(Tiada)',
        ],
        'encrypter' => [
            'class'=>'\nickcv\encrypter\components\Encrypter',
            'globalPassword'=>'spsb@123',
            'iv'=>'1234567890123456',
            'useBase64Encoding'=>true,
            'use256BitesEncoding'=>false,
        ],
    ],
    'timeZone' => 'Asia/Kuala_Lumpur',
    'modules' => [
        'datecontrol' =>  [
             'class' => 'kartik\datecontrol\Module',

             // format settings for displaying each date attribute (ICU format example)
             'displaySettings' => [
                 Module::FORMAT_DATE => 'dd-MM-yyyy',
                 Module::FORMAT_TIME => 'hh:mm:ss a',
                 Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm', 
             ],

             // format settings for saving each date attribute (PHP format example)
             'saveSettings' => [
                 Module::FORMAT_DATE => 'php:Y-m-d', // saves as unix timestamp
                 Module::FORMAT_TIME => 'php:H:i:s',
                 Module::FORMAT_DATETIME => 'php:Y-m-d H:i:s',
             ],

             // set your display timezone
             'displayTimezone' => 'Asia/Kuala_Lumpur',

             // set your timezone for date saved to db
             'saveTimezone' => 'GMT+8',

             // automatically use kartik\widgets for each of the above formats
             'autoWidget' => true,

             // default settings for each widget from kartik\widgets used when autoWidget is true
             'autoWidgetSettings' => [
                 Module::FORMAT_DATE => ['type'=>2, 'pluginOptions'=>['autoclose'=>true]], // example
                 Module::FORMAT_DATETIME => ['pluginOptions'=>['autoclose'=>true]], // setup if needed
                 Module::FORMAT_TIME => ['pluginOptions'=>['autoclose'=>true]], // setup if needed
             ],

             // custom widget settings that will be used to render the date input instead of kartik\widgets,
             // this will be used when autoWidget is set to false at module or widget level.
             'widgetSettings' => [
                 Module::FORMAT_DATE => [
                     'class' => 'yii\jui\DatePicker', // example
                     'ajaxConversion'=>false,
                     'options' => [
                         'dateFormat' => 'php:d-M-Y',
                         'options' => ['class'=>'form-control'],
                     ]
                 ]
             ]
             // other settings
         ],
		 // eddie start
         //'audit' => 'bedezign\yii2\audit\Audit',
		 // eddie end
        'encrypter' => 'nickcv\encrypter\Module',
     ]
];
