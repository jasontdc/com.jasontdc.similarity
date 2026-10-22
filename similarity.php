<?php

require_once 'similarity.civix.php';

/**
 * Implements hook_civicrm_buildForm().
 *
 * Replaces the built-in contact similarity check on the new contact form 
 * for Individuals and Individual sub-types. 
 *
 * @param string $formName
 * @param CRM_Core_Form $form
 */
function similarity_civicrm_buildForm($formName, &$form) {
  try {
    $templatePath = realpath(dirname(__FILE__)."/templates/CRM/Similarity/Form");
    // Check to see if this is the New Contact form
    if ($formName == 'CRM_Contact_Form_Contact' && !isset($form->_contactId)) {

      //Retrieve the 'contact_ajax_check_similar' setting
      $result = civicrm_api3('Setting', 'get', array(
        'sequential' => 1,
        'return' => array('contact_ajax_check_similar'),
      ));

      //If the setting is enabled, we'll add the similarity check
      if($result['values'][0]['contact_ajax_check_similar'] == "1") {
        // Check to see which contact type we're dealing with and add
        // the appropriate template containing the similarity check.
        if($form->_contactType == "Individual") {
          CRM_Core_Region::instance('page-body')->add(array(
            'template' => $templatePath . "/similarity.Individual.tpl"
          ));
        } else if($form->_contactType == "Household") {
          CRM_Core_Region::instance('page-body')->add(array(
            'template' => $templatePath . "/similarity.Household.tpl"
          ));
        } else if($form->_contactType == "Organization") {
          CRM_Core_Region::instance('page-body')->add(array(
            'template' => $templatePath . "/similarity.Organization.tpl"
          ));
        }
      }
    }
  } catch(Exception $e) {}
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function similarity_civicrm_config(&$config) {
  _similarity_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function similarity_civicrm_install() {
  _similarity_civix_civicrm_install();
}

/**
* Implements hook_civicrm_postInstall().
*
* @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
*/



/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function similarity_civicrm_enable() {
  _similarity_civix_civicrm_enable();
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *

 // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function similarity_civicrm_navigationMenu(&$menu) {
  _similarity_civix_insert_navigation_menu($menu, NULL, array(
    'label' => ts('The Page', array('domain' => 'com.jasontdc.similarity')),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
} // */
