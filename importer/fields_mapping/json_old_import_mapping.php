<?php
// this mapping is used for the following clients :
// - service interim
// - adequat


return [
    "old_job_id" => "offreid", //=> 14306,,
    "job_title" => "poste_titre", //=> "Agent de Quai H/F",
    "job_city" => "lieu", // => "Sud",
    "job_description" => "poste_desc", //=>  "Notre client leader dans le transport de livraison, recherche un agent de quai-plateforme (H/F) pour une mission de nuit \r\n\r\nVotre mission sera essentiellement :\r\n- de charger les camions, \r\n- de r\u00e9ceptionner les camions au retour de tourn\u00e9es, \r\n- de les vider, de classer et ranger les conditionnements, \r\n- de livrer des conditionnements et /ou de proc\u00e9der \u00e0 des enl\u00e8vements chez certains de nos clients, \r\n- de nettoyer et ranger la plateforme en fin d'activit\u00e9.\r\n\r\nTravail sur une plateforme r\u00e9frig\u00e9r\u00e9e (0\u00b0C / +2\u00b0C).\r\n",
    "company_name" => "agence", //=> "Service Int\u00e9rim St Pierre",
    "region" => function ($source) {
        return import_regionNameToCode($source['region'][0]);
    }, //"region", // ["REUNION"],
    "job_profile" => "profil_desc", //=>  "Ordonn\u00e9(e), organis\u00e9(e) et pr\u00e9cis(e), vous savez faire preuve de r\u00e9sistance aux t\u00e2ches r\u00e9p\u00e9titives.\r\n\r\nCe poste vous correspond ? N'h\u00e9sitez plus et venez nous rejoindre !\r\n\r\nId\u00e9alement, vous avez d\u00e9j\u00e0 travaill\u00e9 sur un poste similaire et/ou un poste dans le milieu froid et de la manutention. \r\nVous poss\u00e9dez au minimum 16 mois d'exp\u00e9rience en conduite de PL (man\u0153uvre de camions \u00e0 r\u00e9aliser)\r\n",
    "type_fulltime" => function ($source) {
        if ($source['fulltime']) return "FULLTIME";
        else return "PARTTIME"; // "fulltime", // => false,,
    },
    "job_experience" => "experience",
    "job_study_level" => "diplome",
    "company_description" => "entreprise_desc", //=>  "SERVICE INTERIM, l'un des acteurs majeurs du travail temporaire d'insertion \u00e0 La R\u00e9union, r\u00e9pond, depuis 1999, \u00e0 un v\u00e9ritable besoin des entreprises et des candidats dans tous les secteurs d'activit\u00e9s de l'\u00cele ; sa finalit\u00e9 sociale se trouve au c\u0153ur de ses valeurs " => de simplicit\u00e9, de proximit\u00e9, d'humanit\u00e9, d'excellence et de solidarit\u00e9. Sa devise " => agir, accompagner et r\u00e9ussir.",,
    "job_apply_type" => function ($source) {
        if ($source['candidatureenligne']) return "FORM";
        else return "URL";
    },
    "job_apply_url" => "contact_url", //=>  "https://serviceinterim.fr/candidats/nos-offres-demploi/detail-de-loffre.html?no_cache=1&id_offre=14306",,
    "job_apply_free_text" => function ($source) {
        if (!$source["contact_email"]) return null;
        return 'Envoyez votre candidature à <a target="_blank" href="mailto:' . $source["contact_email"] . '">' . $source["contact_email"] . '</a>'; //=> "",
    },
    "secteur" => function ($source) {
        // handle special code sector for this client
        $id = $source['secteur'];
        if (!$id) return null;

        // from client import id to new id
        $specialSectors = [
            13 => 33, //'Services Administratifs et Commerciaux',
            40 => 14, // 'Distribution Et Vente',
            7  => 35, // 'Services aux Personnes et Collectivité',
            39 => 3, // 'Transport et Logistique',
            27 => 5, // 'Industrie Mécanique et des métaux',
            21 => 6, // 'Batiment, Travaux Publics',
            37 => 28, // 'Santé',
            28 => 17, // 'Formation',
            17 => 8, // 'Type Artisanal',
            38 => 27, // 'Hôtellerie – Restauration',
            33 => 5, // 'Autres Industries'
        ];
        if (isset($specialSectors[$id])) return $specialSectors[$id];

        return import_oldSecteurIdToSecteurId($id);
    }, //"secteur", 
    "contract_type" => function ($source) {
        return import_contractNameToCode($source['contrat']);
    } //"contrat", // ? => "INT",,
    // "company_logo" => "logo" //=> "service_interim.png",
];

// field not used from json
    // "nb_postes" => 1,
    // "userid" => 146278217422651,