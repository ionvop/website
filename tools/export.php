<?php

if (php_sapi_name() != "cli") {
    echo "Please run this script from the command line.";
    exit(1);
}

chdir(dirname(__DIR__, 1));
$db = new SQLite3("database.db");

$query = <<<SQL
    SELECT `sql`
    FROM `sqlite_master`
    WHERE `type` = 'table'
    AND `name` NOT LIKE 'sqlite_%'
SQL;

$tables = $db->query($query);

if ($tables == false) {
    echo "Failed to export database.";
    exit(1);
}

$result = "";

while ($table = $tables->fetchArray()) {
    $result .= "{$table['sql']};\n";
}

$success = file_put_contents("tools/schema.sql", $result);

if ($success == false) {
    echo "Failed to export database.";
    exit(1);
}

echo "Database exported.";
exit(0);