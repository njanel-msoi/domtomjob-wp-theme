<?php

// Liste des éléments
// NOTE : the key are the same than old DB
$STUDY_LEVEL = array(
    1 => "Collège ou lycée",
    2 => "Niveau BAC",
    3 => "BAC pro, BEP, CAP",
    4 => "DUT, BTS, BAC +2",
    5 => "Licence, IEP, BAC +3",
    6 => "Maîtrise, IUP, BAC +4",
    7 => "DESS, DEA, Grandes Ecoles, BAC +5",
    8 => "Doctorat, 3ème cycle",
    9 => "Expert, Recherche"
);

// build a format compatible with wpjb plugin
$STUDY_LEVEL_MAP = str_arr_to_data_map($STUDY_LEVEL, true);

function dtj_get_study_level()
{
    global $STUDY_LEVEL_MAP;
    return $STUDY_LEVEL_MAP;
}
