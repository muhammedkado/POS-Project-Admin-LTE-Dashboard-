<?php

return [
    // One-click demo sign-in keys used by the portfolio: GET /{locale}/demo/{key}.
    // Only these accounts can be logged into that way; unknown keys 404.
    'accounts' => [
        'admin'      => 'admin@app.com',
        'superadmin' => 'superadmin@app.com',
        'user'       => 'user@app.com',
    ],

    // Seeded accounts that a public demo visitor must not be able to modify or delete.
    'protected_emails' => [
        'superadmin@app.com',
        'admin@app.com',
        'user@app.com',
    ],
];
