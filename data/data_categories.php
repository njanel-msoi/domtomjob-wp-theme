<?php
$CATEGORIES = [
    50 => "Achat, Logistique",
    4 => "Animaux, Nature",
    7 => "Art, Design, Décoration",
    8 => "Artisanat, Petit Commerce",
    10 => "Banque, Finance, Assurance",
    51 => "Bien-Être, Relaxation",
    52 => "Bilan De Compétences, VAE",
    6 => "BTP, Travaux, Architecture",
    53 => "Bureautique, Office",
    14 => "Commerce, Marketing",
    26 => "Communication, Événementiel",
    54 => "Comptabilité, Gestion",
    29 => "Défense, Sécurité, Secourisme",
    55 => "Développement Personnel, Épanouissement",
    56 => "Digital, Internet",
    17 => "Enseignement, Coaching",
    57 => "Esthétique, Coiffure",
    2 => "Fonction Publique, Citoyenneté, Droit",
    27 => "Hôtellerie, Restauration, Cuisine",
    20 => "Immobilier, Urbanisme",
    5 => "Industrie, Matériaux, Énergie",
    22 => "Informatique, DATA, SIG",
    58 => "Langues",
    59 => "Management, Direction",
    60 => "Petite Enfance, Puériculture",
    61 => "Qualité Hygiène Sécurité Environnement",
    62 => "Réseaux, Telecom",
    63 => "Ressources Humaines, Paie",
    28 => "Santé, Médecine",
    11 => "Sciences",
    33 => "Secrétariat, Accueil",
    35 => "Social, Services à la Personne",
    32 => "Tourisme, Loisirs",
    3 => "Transport, Permis",
    1 => "Tous les domaines d'activité"
];
$CATEGORIES_MAP = str_arr_to_data_map($CATEGORIES, true);

// OLD BEHAVIOR WITH "TAG" categories
/*
$list = new Daq_Db_Query();
$list->select();
$list->from("Wpjb_Model_Tag t");
$list->where("type = ?", Wpjb_Model_Tag::TYPE_CATEGORY);
$CATEGORIES = $list->execute();
$CATEGORIES_MAP = object_arr_to_data_map($CATEGORIES, 'title');
*/
function dtj_get_categories()
{
    global $CATEGORIES_MAP;
    return $CATEGORIES_MAP;
}

function dtj_get_category_from_key($key)
{
    global $CATEGORIES_MAP;
    return data_value_from_key($key, $CATEGORIES_MAP);
}
