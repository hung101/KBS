<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'support@example.com',
    'user.passwordResetTokenExpire' => 3600,
	// eddie start
    'expiryTimeout' => 1000, // 300 sec / 5 minutes
    'passwordExpiry' => 90 * 24 * 60 * 60, // 90 days in sec
    'allowLoginAttempt' => 3, // number of allow login attemption
    'allowConcurrentLogin' => true, // reset auth key if false
	// eddie end
];
