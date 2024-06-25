<?php
function taxFromRegion($region_key)
{
    // refer to data_regions to get the real link between id and name
    switch ($region_key) {
        case 17: //'France métropolitaine'
            return 8.5;
        case 1: //'Guadeloupe'
            return 8.5;
        case 3: //'Guyane'
            return 8.5;
        case 14: //'Île Maurice'
            return 8.5;
        case 16: //'Les Comores'
            return 8.5;
        case 15: //'Madagascar'
            return 8.5;
        case 2: //'Martinique'
            return 8.5;
        case 5: //'Mayotte'
            return 8.5;
        case 6: //'Nouvelle Calédonie'
            return 8.5;
        case 7: //'Polynésie Française'
            return 3.25;
        case 4: //'Réunion'
            return 8.5;
        case 18: //'Saint Barthélémy'
            return 8.5;
        case 10: //'Saint-Martin'
            return 8.5;
        case 9: //'Saint-Pierre et Miquelon'
            return 8.5;
        case 20: //'Seychelles'
            return 8.5;
        case 11: //'T.A.A.F.'
            return 8.5;
        case 8: //'Wallis et Futuna'
            return 8.5;
        case 99: //'Autre'
            return 0;
    }
}
