<?php
/**
 * @file
 * Contains \Drupal\amazing_forms\Form\ContributeForm.
 */

namespace Drupal\modify\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\UrlHelper;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\ChangedCommand;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Ajax\HtmlCommand;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Database\Database;

/**
 * Contribute form.
 */
class ModifyForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
	  return 'modify_form';
  }

function test(array &$form, FormStateInterface $form_state) {
	
	$database = \Drupal::database();

	/*
	global $user;
$uid = $user->uid;
echo $uid;
	*/
		$response = new AjaxResponse();
		$username = $form_state->getValue('title');
		//$sql = "SELECT name FROM users_field_data WHERE name = '".$full_name."' ";
		
		/*$user = $database->query("SELECT uid FROM users_field_data WHERE name=':username'", array(":username" => $username));
		print_r($user['uid']);*/
		
		
		$sql = "SELECT uid,name FROM users_field_data WHERE name = :username";
		$result = $database->query($sql, [':username' => $username]);
		$row = $result->fetchAssoc();
/*if ($result) {
  while ($row = $result->fetchAssoc()) {
    // Do something with:
    echo $row['uid'];
    // $row['quantity']
  }
}*/
		
		
		
		//return $user->uid;
		$css = ['border' => '1px solid red'];
        $message = t('Please enter your full name '.$row['name']);
        $response->addCommand(new CssCommand('.user-full-name', $css));
        $response->addCommand(new HtmlCommand('.user-full-name', $message));
	
	return $response;
	
	 /*$ajax_response = new AjaxResponse();
     if (user_load_by_name($form_state->getValue('user_name')) && $form_state->getValue('user_name') != false) {
      $text = 'User Found';
      $color = 'green';
    } else {
      $text = 'No User Found';
      $color = 'red';
    }
     $ajax_response->addCommand(new HtmlCommand('#edit-user-name--description', $text));
     $ajax_response->addCommand(new InvokeCommand('#edit-user-name--description', 'css', array('color', $color)));
     return $ajax_response;
	 */
	 
	 
  //global $user;
  
  /*db_query('DELETE FROM madymanish WHERE rid=%d', );*/

  //$result = db_query('SELECT COUNT(*) as count FROM madymanish WHERE uid=%d', $user->uid);
   
  /*$result = db_query('SELECT COUNT(*) as count FROM users_field_data ');
  return $result;
  $registry_items = db_fetch_object($result);
  print_r( $registry_items);
*/
   //print_r($_REQUEST);
}




  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
	  
	  $form['title'] = array(
      '#type' => 'textfield',
      '#title' => t('Title'),
      '#required' => TRUE,
	  '#suffix' => '<span class="user-full-name"></span>',
	   '#ajax' => array(
        'callback' => '::test',
        'effect' => 'fade',
        'event' => 'blur',
        'progress' => array(
        'type' => 'throbber',
        'message' => NULL,
        ),
      ),
    );
    $form['video'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube video'),
    );
    $form['video'] = array(
      '#type' => 'textfield',
      '#title' => t('Youtube video'),
    );
    $form['develop'] = array(
      '#type' => 'checkbox',
      '#title' => t('I would like to be involved in developing this material'),
    );
    $form['description'] = array(
      '#type' => 'textarea',
      '#title' => t('Description'),
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
   
  }




function ModifyForm_node_view($node, $view_mode) {

  // Attach Ajax node count statistics if configured.
 
	  $statistics = drupal_get_path('module', 'modify') . 'js/test.js';
      $node->content['#attached']['js'][$statistics] = array( 'scope' => 'footer');
      $settings = array( 'url' => url(drupal_get_path('module', 'modify') . '/modify.php'));
      $node->content['#attached']['js'][] = array( 'data' => array(  'statistics' => $settings,  ), 'type' => 'setting',  );
 }
 
 
 
 
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }
}
?>