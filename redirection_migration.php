<?php
$oldJobId = get_query_var('oldJobId');

if ($oldJobId) {
    // redirection d'une ancienne offre d'emploi
    $oldJobId = urldecode($oldJobId);

    // présent dans la nouvelle base ?

    // sinon 404 spécial job
    include dirname(__FILE__) . "/templates/404-job.page.php";
}

// rien n'a été trouvé, redirection 404
include dirname(__FILE__) . "/404.php";
