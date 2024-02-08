<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'utilisateurs' => [
        'name' => 'Utilisateurs',
        'index_title' => 'Liste des utilisateurs',
        'new_title' => 'Nouveau utilisateur',
        'create_title' => 'Créer un utilisateur',
        'edit_title' => 'Editer un utilisateur',
        'show_title' => 'Détails ',
        'inputs' => [
            'name' => 'Nom',
            'email' => 'Adresse E-mail',
            'password' => 'Mot de passe',
        ],
    ],

    'user_entreprises' => [
        'name' => 'User Entreprises',
        'index_title' => 'Entreprises List',
        'new_title' => 'New Entreprise',
        'create_title' => 'Create Entreprise',
        'edit_title' => 'Edit Entreprise',
        'show_title' => 'Show Entreprise',
        'inputs' => [
            'raison_sociale' => 'Raison Sociale',
            'siren' => 'Siren',
            'siret' => 'Siret',
            'ville' => 'Ville',
            'code_postal' => 'Code Postal',
            'adresse' => 'Adresse',
            'details' => 'Details',
        ],
    ],

    'user_historiques' => [
        'name' => 'User Historiques',
        'index_title' => 'Historiques List',
        'new_title' => 'New Historique',
        'create_title' => 'Create Historique',
        'edit_title' => 'Edit Historique',
        'show_title' => 'Show Historique',
        'inputs' => [
            'entreprise_id' => 'Entreprise',
            'action' => 'Action',
            'type' => 'Type',
        ],
    ],

    'compteurelecs' => [
        'name' => 'Compteurelecs',
        'index_title' => 'Compteurelecs List',
        'new_title' => 'New Compteurelec',
        'create_title' => 'Create Compteurelec',
        'edit_title' => 'Edit Compteurelec',
        'show_title' => 'Show Compteurelec',
        'inputs' => [
            'PDL' => 'Pdl',
            'site_id' => 'Site',
        ],
    ],

    'compteurgazs' => [
        'name' => 'Compteurgazs',
        'index_title' => 'Compteurgazs List',
        'new_title' => 'New Compteurgaz',
        'create_title' => 'Create Compteurgaz',
        'edit_title' => 'Edit Compteurgaz',
        'show_title' => 'Show Compteurgaz',
        'inputs' => [
            'PCE' => 'Pce',
            'site_id' => 'Site',
        ],
    ],

    'contacts' => [
        'name' => 'Contacts',
        'index_title' => 'Contacts List',
        'new_title' => 'New Contact',
        'create_title' => 'Create Contact',
        'edit_title' => 'Edit Contact',
        'show_title' => 'Show Contact',
        'inputs' => [
            'civilite' => 'Civilite',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'fonction' => 'Fonction',
            'mobile' => 'Mobile',
            'fix' => 'Fix',
            'signataire' => 'Signataire',
            'decisionnaire' => 'Decisionnaire',
            'site_id' => 'Site',
        ],
    ],

    'scores' => [
        'name' => 'Scores',
        'index_title' => 'Scores List',
        'new_title' => 'New Score',
        'create_title' => 'Create Score',
        'edit_title' => 'Edit Score',
        'show_title' => 'Show Score',
        'inputs' => [
            'creditsafe' => 'Creditsafe',
            'elipro' => 'Elipro',
            'entreprise_id' => 'Entreprise',
        ],
    ],

    'sites' => [
        'name' => 'Sites',
        'index_title' => 'Sites List',
        'new_title' => 'New Site',
        'create_title' => 'Create Site',
        'edit_title' => 'Edit Site',
        'show_title' => 'Show Site',
        'inputs' => [
            'siret' => 'Siret',
            'ville' => 'Ville',
            'code_postal' => 'Code Postal',
            'adresse' => 'Adresse',
            'entreprise_id' => 'Entreprise',
        ],
    ],

    'site_compteurelecs' => [
        'name' => 'Site Compteurelecs',
        'index_title' => 'Compteurelecs List',
        'new_title' => 'New Compteurelec',
        'create_title' => 'Create Compteurelec',
        'edit_title' => 'Edit Compteurelec',
        'show_title' => 'Show Compteurelec',
        'inputs' => [
            'PDL' => 'Pdl',
        ],
    ],

    'site_compteurgazs' => [
        'name' => 'Site Compteurgazs',
        'index_title' => 'Compteurgazs List',
        'new_title' => 'New Compteurgaz',
        'create_title' => 'Create Compteurgaz',
        'edit_title' => 'Edit Compteurgaz',
        'show_title' => 'Show Compteurgaz',
        'inputs' => [
            'PCE' => 'Pce',
        ],
    ],

    'site_cahiercharges' => [
        'name' => 'Site Cahiercharges',
        'index_title' => 'Cahiercharges List',
        'new_title' => 'New Cahiercharge',
        'create_title' => 'Create Cahiercharge',
        'edit_title' => 'Edit Cahiercharge',
        'show_title' => 'Show Cahiercharge',
        'inputs' => [
            'duree_contrat' => 'Duree Contrat',
            'energie_verte' => 'Energie Verte',
            'encouter_les_opportunites' => 'Encouter Les Opportunites',
            'frequence_facturation' => 'Frequence Facturation',
            'type_offre' => 'Type Offre',
            'mode_paiement' => 'Mode Paiement',
            'offre_fournisseur' => 'Offre Fournisseur',
        ],
    ],

    'cahier_des_charges' => [
        'name' => 'Cahier des charges',
        'index_title' => 'Cahiers des charges',
        'new_title' => 'Nouveau cachier des charges',
        'create_title' => 'Nouveau Cahier des charges',
        'edit_title' => 'Mettre à jour le cahier des charge',
        'show_title' => 'Détail de cahier des charges',
        'inputs' => [
            'duree_contrat' => 'Duree Contrat',
            'energie_verte' => 'Energie Verte',
            'encouter_les_opportunites' => 'Encouter Les Opportunites',
            'frequence_facturation' => 'Frequence Facturation',
            'type_offre' => 'Type Offre',
            'mode_paiement' => 'Mode Paiement',
            'offre_fournisseur' => 'Offre Fournisseur',
            'site_id' => 'Site',
        ],
    ],

    'site_contacts' => [
        'name' => 'Site Contacts',
        'index_title' => 'Contacts List',
        'new_title' => 'New Contact',
        'create_title' => 'Create Contact',
        'edit_title' => 'Edit Contact',
        'show_title' => 'Show Contact',
        'inputs' => [
            'civilite' => 'Civilite',
            'nom' => 'Nom',
            'prenom' => 'Prenom',
            'fonction' => 'Fonction',
            'mobile' => 'Mobile',
            'fix' => 'Fix',
            'signataire' => 'Signataire',
            'decisionnaire' => 'Decisionnaire',
        ],
    ],

    'contact_cpps' => [
        'name' => 'Contact Cpps',
        'index_title' => 'Cpps List',
        'new_title' => 'New Cpp',
        'create_title' => 'Create Cpp',
        'edit_title' => 'Edit Cpp',
        'show_title' => 'Show Cpp',
        'inputs' => [
            'fichier' => 'Fichier',
            'signe' => 'Signe',
        ],
    ],

    'contact_signatures' => [
        'name' => 'Contact Signatures',
        'index_title' => 'Signatures List',
        'new_title' => 'New Signature',
        'create_title' => 'Create Signature',
        'edit_title' => 'Edit Signature',
        'show_title' => 'Show Signature',
        'inputs' => [
            'fichier' => 'Fichier',
            'signe' => 'Signe',
        ],
    ],

    'signatures' => [
        'name' => 'Signatures',
        'index_title' => 'Signatures List',
        'new_title' => 'New Signature',
        'create_title' => 'Create Signature',
        'edit_title' => 'Edit Signature',
        'show_title' => 'Show Signature',
        'inputs' => [
            'fichier' => 'Fichier',
            'signe' => 'Signe',
            'contact_id' => 'Contact',
        ],
    ],

    'cpps' => [
        'name' => 'Cpps',
        'index_title' => 'Cpps List',
        'new_title' => 'New Cpp',
        'create_title' => 'Create Cpp',
        'edit_title' => 'Edit Cpp',
        'show_title' => 'Show Cpp',
        'inputs' => [
            'fichier' => 'Fichier',
            'signe' => 'Signe',
            'contact_id' => 'Contact',
        ],
    ],

    'entreprises' => [
        'name' => 'Entreprises',
        'index_title' => 'Entreprises List',
        'new_title' => 'New Entreprise',
        'create_title' => 'Create Entreprise',
        'edit_title' => 'Edit Entreprise',
        'show_title' => 'Show Entreprise',
        'inputs' => [
            'raison_sociale' => 'Raison Sociale',
            'siren' => 'Siren',
            'siret' => 'Siret',
            'ville' => 'Ville',
            'code_postal' => 'Code Postal',
            'adresse' => 'Adresse',
            'details' => 'Details',
            'user_id' => 'Utilisateur associé',
        ],
    ],

    'entreprise_sites' => [
        'name' => 'Entreprise Sites',
        'index_title' => 'Sites List',
        'new_title' => 'New Site',
        'create_title' => 'Create Site',
        'edit_title' => 'Edit Site',
        'show_title' => 'Show Site',
        'inputs' => [
            'siret' => 'Siret',
            'ville' => 'Ville',
            'code_postal' => 'Code Postal',
            'adresse' => 'Adresse',
        ],
    ],

    'entreprise_scores' => [
        'name' => 'Entreprise Scores',
        'index_title' => 'Scores List',
        'new_title' => 'New Score',
        'create_title' => 'Create Score',
        'edit_title' => 'Edit Score',
        'show_title' => 'Show Score',
        'inputs' => [
            'creditsafe' => 'Creditsafe',
            'elipro' => 'Elipro',
        ],
    ],

    'entreprise_historiques' => [
        'name' => 'Entreprise Historiques',
        'index_title' => 'Historiques List',
        'new_title' => 'New Historique',
        'create_title' => 'Create Historique',
        'edit_title' => 'Edit Historique',
        'show_title' => 'Show Historique',
        'inputs' => [
            'user_id' => 'User',
            'action' => 'Action',
            'type' => 'Type',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
