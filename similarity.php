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
 * Implements hook_civicrm_xmlMenu().
 *
 * @param array $files
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function similarity_civicrm_xmlMenu(&$files) {
  _similarity_civix_civicrm_xmlMenu($files);
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
function similarity_civicrm_postInstall() {
  _similarity_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function similarity_civicrm_uninstall() {
  _similarity_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function similarity_civicrm_enable() {
  _similarity_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function similarity_civicrm_disable() {
  _similarity_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @param $op string, the type of operation being performed; 'check' or 'enqueue'
 * @param $queue CRM_Queue_Queue, (for 'enqueue') the modifiable list of pending up upgrade tasks
 *
 * @return mixed
 *   Based on op. for 'check', returns array(boolean) (TRUE if upgrades are pending)
 *                for 'enqueue', returns void
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function similarity_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _similarity_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function similarity_civicrm_managed(&$entities) {
  _similarity_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * @param array $caseTypes
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function similarity_civicrm_caseTypes(&$caseTypes) {
  _similarity_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function similarity_civicrm_angularModules(&$angularModules) {
_similarity_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function similarity_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _similarity_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Functions below this ship commented out. Uncomment as required.
 *

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function similarity_civicrm_preProcess($formName, &$form) {

} // */

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
  _similarity_civix_navigationMenu($menu);
} // */
