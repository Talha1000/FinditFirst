<?php
// Database connection details
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

// Backup file to restore
$backup_file = "/path/to/backup/directory/backup_20220101_120000.sql";

// Restore database from SQL file
$command = "mysql -h {$db_host} -u {$db_username} -p{$db_password} {$db_name} < {$backup_file}";
system($command, $output);

if ($output === 0) {
    echo "Database restore successful.";
} else {
    echo "Database restore failed. Error code: {$output}";
}
?>
