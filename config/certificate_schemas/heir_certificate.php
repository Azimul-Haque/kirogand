<?php
// config/certificate_schemas/heir_certificate.php

return [
    'title' => 'Heir Succession Certificate',
    'fields' => [
        // --- Main Decedent/Location Fields ---
        [
            'name' => 'decedent_name',
            'label' => 'Name of Deceased',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:255',
        ],
        [
            'name' => 'decedent_id',
            'label' => 'NID or Birth Registration No.',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|min:10|max:20',
        ],
        [
            'name' => 'father_name',
            'label' => 'Father\'s Name',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:255',
        ],
        [
            'name' => 'mother_name',
            'label' => 'Mother\'s Name',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:255',
        ],
        [
            'name' => 'village',
            'label' => 'Village/Area',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:100',
        ],
        [
            'name' => 'ward',
            'label' => 'Ward No.',
            'type' => 'number',
            'required' => true,
            'rules' => 'required|integer|min:1|max:99',
        ],
        [
            'name' => 'post_office',
            'label' => 'Post Office',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:100',
        ],
        [
            'name' => 'union',
            'label' => 'Union/City',
            'type' => 'text',
            'required' => true,
            'rules' => 'required|string|max:100',
        ],

        // --- Tabular Data Field (Heirs List) ---
        [
            'name' => 'heirs_list',
            'label' => 'Heir List (JSON Array Input)',
            'type' => 'json_editor', 
            'required' => true,
            'rules' => 'required|json', // Validates the entire block is correct JSON
            'placeholder' => 
                '[' . "\n" . 
                '  {"name": "Heir Name", "relation": "Wife/Son/Daughter", "nid_or_birth": "ID No.", "dob": "YYYY-MM-DD", "remark": "Optional Note"}' . "\n" .
                ']'
        ],
    ]
];
