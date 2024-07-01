<?php

/**
 * Mapping for to import old DB job offers
 */

/**
 * A mapping file should return an array with list of fields of DTJ Job
 * For each field you can set a value which can be :
 * - the name of a key of the source job
 * - a function which returns the value for this field. This function accept 2 parameters : the source job and the company object which posted the job
 * 
 * Please note that jobs are already prefilled with data from the company. So no need to map contact & billing fields from company, it's already done by "fillJobCompanyFromCompany"
 */

$old_contracttype_mapping = include dirname(__FILE__) . '/old_contract_type_mapping.php';

return [
    "company_name" => "off_societe",

    "old_job_id" => "off_code",
    "job_title" => function ($source) {
        return str_replace('f/h', 'F/H', ucfirst(strtolower($source["off_lb"])));
    },
    "type" => function ($source) {
        global $old_contracttype_mapping;
        $oldType = $source['odd_contrat'];
        if (!$oldType) return null;
        return $old_contracttype_mapping[$oldType];
    }, // "off_contrat",
    "job_city" => function ($source) {
        return ucfirst(strtolower($source["off_lieu_travail"]));
    },
    "region" => function ($source, $company) {
        return get_meta_value($company, 'region');
    },
    "job_description" => function ($source) {
        $desc = $source['off_description'] . '<br><br>' . $source['off_commentaire'];
        return str_replace('__br__', '<br>', $desc);
    },
    "job_created_at" => function ($source) {
        $date = DateTime::createFromFormat('d/m/Y', $source["off_date_creation"]);
        return $date->format('Y-m-d');
    },
    "job_modified_at" => function ($source) {
        $date = DateTime::createFromFormat('d/m/Y', $source["off_date_modification"]);
        return $date->format('Y-m-d');
    },
    "job_expires_at" => function ($source) {
        $date = DateTime::createFromFormat('d/m/Y', $source["off_date_lim"]);
        return $date->format('Y-m-d');
    },
    "is_approved" => function ($source) {
        $status = $source["off_statut"];
        return $status == "1" || $status == 1 ? 1 : 0;
    },
    "is_active" => function ($source) {
        $status = $source["off_statut"];
        return $status == "2" || $status == 2 ? 0 : 1;
    },
    // "is_filled" => "",
    "is_featured" => function ($source) {
        $mea = $source['off_mea'];
        return $mea && $mea != 0 && $mea != '0' && $mea != 'Aucune' ? 1 : 0;
    },
    "job_is_anonymous" => function ($source) {
        return $source['off_societe'] == "Confidentiel" ? "1" : "0";
    },
    "secteur" => "off_secteur", //TODO need mapping
    "job_profile" => function ($source) {
        return str_replace('__br__', '<br>', $source["off_profile"]);
    },
    "type_fulltime" => function ($source) {
        return (str_contains(strtolower($source['off_description']), 'temps partiel'))
            ? "PARTTIME" : "FULLTIME";
    },
    "job_function" => "fon_code", // TODO need mapping
    "salary_min" => "off_salaire_min",
    "salary_max" => function ($source) {
        return $source['off_salaire_min'] ? $source['off_salaire'] : '';
    },
    "job_salary_txt" => function ($source) {
        return !$source['off_salaire_min'] ? $source['off_salaire'] : '';
    },
    "job_experience" => "off_exp",
    "job_study_level" => "off_diplome",
    "job_duration" => "off_cdd_duree",
    // "company_siret" => "",
    "job_phone" => "off_rep_tel",
    "job_apply_type" => function ($source) {
        if ($source['off_reponsepar_web'] == "1") return "URL";
        if ($source['off_reponsepar_courrier'] == "1" || $source['off_reponsepar_tel'] == "1") return "TEXT";

        return "FORM";
    },
    "job_apply_url" => function ($source) {
        if ($source['off_reponsepar_url']) return $source['off_reponsepar_url'];
        else return $source['url_repondre'];
    },
    "job_apply_free_text" => function ($source) {
        $parts = [
            $source['off_rep_adresse'],
            $source['off_rep_cp'],
            $source['off_rep_ville'],
            $source['off_rep_tel']
        ];
        return implode('<br>', array_filter($parts, function ($c) {
            return !empty($c);
        }));
    },

    //"optin_group" => ""
];
