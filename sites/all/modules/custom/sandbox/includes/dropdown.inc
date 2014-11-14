<?php
/**
 * Function for generating form
 */
function sandbox_ajax_dropdown($form, &$form_state) {
  // Province dropdown list
  $form['sandbox_ajax_dropdown']['country'] = array(
    '#title' => t('Country'),
    '#type' => 'select',
    '#options' => _load_country(),
    "#weight" => 1,
    '#ajax' => array(
      'event'=>'change',
      'callback' =>'sandbox_ajax_dropdown_states',
      'wrapper' => 'city-wrapper',
    ),
  );

  // Wrapper for city dropdown list
  $form['sandbox_ajax_dropdown']['wrapper'] = array(
    '#prefix' => '<div id="city-wrapper">',
    '#suffix' => '</div>',
    "#weight" => 2,
    
  );

  // Options for city dropdown list
  $options = array('- Select states -');
  if (isset($form_state['values']['country'])) {
    // Pre-populate options for city dropdown list if province id is set
    $options = _load_states($form_state['values']['country']);
  }

  // Province dropdown list
  $form['sandbox_ajax_dropdown']['wrapper']['states'] = array(
    '#title' => t('States'),
    '#type' => 'select',
    '#options' => $options,
     '#ajax' => array(
      'event'=>'change',
      'callback' =>'sandbox_ajax_dropdown_city',
      'wrapper' => 'city-wrapper2',
    ),
  );

   $form['sandbox_ajax_dropdown']['wrapper2'] = array(
    '#prefix' => '<div id="city-wrapper2">',
    '#suffix' => '</div>',
    "#weight" => 3,
    
  );

  // Options for city dropdown list
  $options2 = array('- Select city -');
  if (isset($form_state['values']['states'])) {
    // Pre-populate options for city dropdown list if province id is set
    $options2 = _load_city($form_state['values']['states']);
  }
$form['sandbox_ajax_dropdown']['wrapper2']['city'] = array(
    '#title' => t('City'),
    '#type' => 'select',
    '#options' => $options2,
    
  );

  // Form submit button
  $form["sandbox_ajax_dropdown"]["submit"] = array(
    "#value"  => t("Submit"),
    "#type"   => "submit",
    "#weight" => 10,
    "#submit" => array("sandbox_ajax_dropdown_submit"),
    
  );

  return $form;
}

/**
 * Function for handling form submission
 */
function sandbox_ajax_dropdown_submit($form, &$form_state) {
  $replacement = array(
    '@country_id' => $form_state['values']['country'],
    '@states_id' => $form_state['values']['states'],
    '@city_id' => $form_state['values']['city'],
  );

  drupal_set_message(t('Submitted data: Country ID = @country_id, State ID = @states_id, City ID = @city_id .', $replacement));
}

/**
 * Function for handling ajax request
 */
function sandbox_ajax_dropdown_states($form, $form_state) {
  // Return the dropdown list including the wrapper
  return $form['sandbox_ajax_dropdown']['wrapper'];
}


 /**
 * Function for handling ajax request
 */
function sandbox_ajax_dropdown_city($form, $form_state) {
  // Return the dropdown list including the wrapper
  return $form['sandbox_ajax_dropdown']['wrapper2'];
}
/**
 * Function for populating province
 */
function _load_country() {
  $province = array('- Select country -');

  // Select table
  $query = db_select("sandbox_country", "a");
  // Selected fields
  $query->fields("a", array('id', 'name'));
  // Filter the active ones only
  $query->condition("a.status", 1);
  // Order by name
  $query->orderBy("a.name");
  // Execute query
  $result = $query->execute();

  while($row = $result->fetchObject()){
    // Key-value pair for dropdown options
    $province[$row->id] = $row->name;
  }

  return $province;
}

/**
 * Function for populating city
 */
function _load_states($country_id) {
  $states = array('- Select city -');

  // Select table
  $query = db_select("sandbox_states", "a");
  // Selected fields
  $query->fields("a", array('id', 'name'));
  // Filter the active ones only
  $query->condition("a.status", 1);
  // Filter based province id
  $query->condition("a.country_id", $country_id);
  // Order by name
  $query->orderBy("a.name");
  // Execute query
  $result = $query->execute();

  while($row = $result->fetchObject()){
    // Key-value pair for dropdown options
    $states[$row->id] = $row->name;
  }

  return $states;
}

/**
 * Function for populating city
 */
function _load_city($state_id) {
  $city = array('- Select city -');

  // Select table
  $query = db_select("sandbox_city", "a");
  // Selected fields
  $query->fields("a", array('id', 'name'));
  // Filter the active ones only
  $query->condition("a.status", 1);
  // Filter based province id
  $query->condition("a.state_id", $state_id);
  // Order by name
  $query->orderBy("a.name");
  // Execute query
  $result = $query->execute();

  while($row = $result->fetchObject()){
    // Key-value pair for dropdown options
    $city[$row->id] = $row->name;
  }

  return $city;
}
