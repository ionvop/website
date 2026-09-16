<?php

$OPENAI_API_KEY = "";

// Password required to access the admin page (admin/).
// Set this to a bcrypt hash of your password, e.g. generated with:
//   php -r "echo password_hash('YOUR_PASSWORD', PASSWORD_DEFAULT);"
// NOTE: wrap the hash in single quotes — it contains `$` which PHP would
// interpolate as a variable inside double quotes.
$ADMIN_PASSWORD = '';