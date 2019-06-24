<?php

return [
    '^password\/(\w+)\/(\w+)$' => '$1/$2',
    '^password\/(\w+)$' => '$1',
    '^profile\/(\w+)\/(\w+)$' => '$1/$2',
    '^profile\/(\w+)$' => '$1',
    '^(\w+)\/(\w+)$' => '$1/$2',
    '^(\w+)$' => '$1',
    'default_controller' => 'signup'
];