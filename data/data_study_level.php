<?php

// Liste des éléments
$STUDY_LEVEL = array(
    'CollegeouLycee' => 'Collège ou Lycée',
    'NiveauBac' => 'Niveau Bac',
    'BacProBEP' => 'Bac Pro, BEP, CAP',
    'DUTBTSBac2' => 'DUT, BTS, Bac 2',
    'LicenceIEPBac3' => 'Licence, IEP, Bac 3',
    'MaitriseIUPBac4' => 'Maîtrise, IUP, Bac 4',
    'DESSDEAGrandesEcolesBac5' => 'DESS, DEA, Grandes Ecoles, Bac 5',
    'Doctorat3emecycle' => 'Doctorat, 3ème cycle',
    'ExpertRecherche' => 'Expert, Recherche'
);

// build a format compatible with wpjb plugin
$STUDY_LEVEL_MAP = str_arr_to_data_map($STUDY_LEVEL, true);

function dtj_get_study_level()
{
    global $STUDY_LEVEL_MAP;
    return $STUDY_LEVEL_MAP;
}
