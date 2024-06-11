<?php

/**
 * Type de donnée pour les champs de saisie "optin" :
 * - abonnement aux offres de groupe
 * - abonnement aux offres des partenaires
 */

$OPTIN_TYPES_MAP = [
    'optin_group' => [
        ['key' => '1', 'value' => '1', "description" => "J'accepte de recevoir les offres du groupe"],
    ],
    'optin_partners' => [
        ['key' => '1', 'value' => '1', "description" => "J'accepte de recevoir les offres des partenaires"],
    ]
];

function dtj_get_optin_group()
{
    global $OPTIN_TYPES_MAP;
    return $OPTIN_TYPES_MAP['optin_group'];
}

function dtj_get_optin_partner()
{
    global $OPTIN_TYPES_MAP;
    return $OPTIN_TYPES_MAP['optin_partners'];
}
