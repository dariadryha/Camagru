<?php
return [
    'action' => '/signup/signup',
    'inputs' => [
        'username' => [
            'attributes' => [
                'name' => 'username',
                'type' => 'text',
                'minlength' => 6,
                'maxlength' => 12,
                'id' => 'username'
            ],
//            'validators' => [
//                'NotEmpty',
//                'StrLength' => [
//                    'minlength',
//                    'maxlength'
//                ],
//                'PatternHandlers' => [
//                    $this->patterns['username']
//                ],
//                'NoRecordExists' => [
//                    'Users',
//                    'username'
//                ]
//            ],
            'label' => 'Username'
        ],
        'email' => [
            'attributes' => [
                'name' => 'email',
                'type' => 'email',
                'id' => 'email'
            ],
            'label' => 'Email'
        ],
        'password' => [
            'attributes' => [
                'name' => 'password',
                'type' => 'password',
                'id' => 'password',
                'minlength' => 6,
                'maxlength' => 12,
                'autocomplete' => 'off'
            ],
            'label' => 'Password'
        ],
        'confirm_password' => [
            'attributes' => [
                'name' => 'confirm_password',
                'type' => 'password',
                'id' => 'confirm_password',
                'autocomplete' => 'off'
            ],
            'label' => 'Confirm password'
        ]
    ],
    'submit' => [
        'type' => 'submit',
        'value' => "'Sign up'"
    ]
];