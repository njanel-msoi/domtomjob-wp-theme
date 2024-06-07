<?php


function preDump($var)
{
    echo '<pre>';
    var_dump($var);
    echo '</pre>';
}

function isRecruteurPage()
{
    $pagesRecruteur = array(222, 16, 8, 95, 12, 10, 239);
    if (in_array(get_the_ID(), $pagesRecruteur)) return true;

    // is from single cv page ? (from rewrite rule)
    if (get_post_type() == 'resume') return true;

    return false;
}

function is_company_connected()
{
    $resume = Wpjb_Model_Company::current();
    return !!$resume;
}

function get_current_resume_field($fieldName)
{
    $resume = Wpjb_Model_Resume::current();
    // if there is no current user, do not search
    if (!$resume) return NULL;

    // search in meta fields
    if (isset($resume->meta->$fieldName)) return $resume->meta->$fieldName->value();
    // search in classic fields
    if (isset($resume->getFields()[$fieldName])) return $resume->getFields()[$fieldName]['value'];

    // search in current user meta data
    $user_id = get_current_user_id();
    $value = get_user_meta($user_id, $fieldName, true);
    if ($value) return $value;

    return NULL;
}

function set_field_value_from_resume($field, $supported_fields_arr)
{
    $fieldName = $field->getName();
    if (!in_array($fieldName, $supported_fields_arr)) return;

    $value = get_current_resume_field($fieldName);
    $field->setValue($value);
}


function is_from_rewrite_rule($queryPath)
{
    return get_query_var($queryPath) == true && get_query_var($queryPath) != '';
}

function get_meta_region($object)
{
    $metaValue = get_meta_value($object, 'region');
    return $metaValue ? $metaValue : 'Région non définie';
}

function get_company_location($company)
{
    $parts = [];
    $parts[] = get_meta_region($company);
    if ($company->company_location) {
        $parts[] = $company->company_location;
    }
    return implode(', ', $parts);
}

function get_meta_value($object, $field)
{
    $meta = $object->getMeta()->$field;
    if ($meta) {
        $metaValues = $meta->getValues();
        if (isset($metaValues[0]))
            return esc_html($metaValues[0]->value);
    }
    return '';
}

function get_job_tag($job, $tag)
{
    $tag = $job->getTag()->$tag;
    if (is_array($tag) && count($tag) > 0)
        return $tag[0]->title;
    return '';
}
function get_job_category($job)
{
    return get_job_tag($job, 'category');
}

function get_job_type($job)
{
    return get_job_tag($job, 'type');
}

function job_company_img($job, $forList = true)
{
    $image = $forList ? "50x50" : "85x85";

    if ($job->getLogoUrl()) : ?>
        <img src="<?php echo $job->getLogoUrl($image) ?>" />
    <?php else : ?>
        <?php company_img($job->getCompany(true), $forList) ?>
    <?php endif;
}

function company_img($company, $forList = true)
{
    $image = $forList ? "50x50" : "85x85";
    if ($company->getLogoUrl()) : ?>
        <img src="<?php echo $company->getLogoUrl($image) ?>" />
    <?php else : ?>
        <div class="logo-placeholder <?= $forList ? 'for-list' : 'for-detail' ?>"></div>
<?php endif;
}

/**
 * Check if current user already applied to $job
 * 
 * @var $job Wpjb_Model_Job
 * @return boolean True if current user already applied to $job
 **/
function my_wpjb_job_already_applied_to(Wpjb_Model_Job $job)
{
    $id = get_current_user_id();

    $query = new Daq_Db_Query();
    $query->from("Wpjb_Model_Application t");
    $query->where("user_id = ?", $id);
    $query->where("job_id = ?", $job->id);
    $query->limit(1);

    $result = $query->execute();

    return !empty($result);
}

function _or($value, $or = '-')
{
    return $value ? $value : $or;
}

function formVal($form, $field)
{
    $val = $form->getElement($field)->getValue();
    if (is_array($val)) {
        return !empty($val) ? $val[0] : '';
    }
    return $val;
}

function data_value_from_key($key, $data)
{
    if (!$key) return '';
    foreach ($data as $value) {
        if ($value['key'] == $key) {
            return $value['description'];
        }
    }
    return '';
}
