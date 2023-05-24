<?php
// Database connection details
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "lost_item";

// Backup directory
$backup_dir = "/path/to/backup/directory/";

// Create a backup filename with timestamp
$backup_file = $backup_dir . "backup_" . date('Ymd_His') . ".sql";

// Dump database into a SQL file
$command = "mysqldump -h {$db_host} -u {$db_username} -p{$db_password} {$db_name} > {$backup_file}";
system($command, $output);

if ($output === 0) {
    echo "Database backup successful. Backup file: {$backup_file}";
} else {
    echo "Database backup failed. Error code: {$output}";
}
?>
