<?php
require_once '../../partials/database.php';

$jobs_records = $conn->prepare('SELECT *
FROM gxc55311.z_payments as p
JOIN gxc55311.z_payment_methods as pm ON p.payment_method_id = pm.payment_method_id
JOIN gxc55311.z_employers ON employer_id = payment_method_user_id
JOIN gxc55311.z_users on user_id = employer_id;
');

$jobs_records->execute();