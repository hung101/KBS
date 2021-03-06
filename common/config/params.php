<?php
return [
    'adminEmail' => 'admin@example.com',
    'supportEmail' => 'noreply@spsb.com',
    'user.passwordResetTokenExpire' => 3600,
	// eddie start
    'expiryTimeout' => 900, // 300 sec = 5 minutes
    'passwordExpiry' => 90 * 24 * 60 * 60, // 90 days in sec
    'allowLoginAttempt' => 3, // number of allow login attemption
    'allowConcurrentLogin' => false, // reset auth key if false
	// eddie end
    'passwordReused' => 4, // new password cannot be same as previous last 4 passwords
    'jasperuser' => 'jasperadmin',
    'jasperpass' => 'jasperadmin',
    'jasperurl' => 'http://10.19.189.87:8080/jasperserver',
];
