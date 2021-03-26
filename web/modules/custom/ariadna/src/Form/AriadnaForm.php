<?php

namespace Drupal\ariadna\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Implements a codimth Simple Form API.
 */
class AriadnaForm extends FormBase {

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   * @return array
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Textfield.
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Nombre'),
      '#size' => 60,
      '#maxlength' => 128,
    ];

    // Color.
    $form['mail'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#size' => 60,
      '#maxlength' => 128,
    ];

    // Add a submit button
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Subscribirse'),
    ];

    return $form;
  }

  /**
   * @return string
   */
  public function getFormId() {
    return 'ariadna_form';
  }

  /**
   * @param array $form
   * @param FormStateInterface $form_state
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Get mail value.
    $mail = $form_state->getValue('mail');
    // Get name value.
    $name = $form_state->getValue('name');
    // The message.
    $msg = "¡Felicidades " . $name . "\nHa sido subscrito a Newsletter de manera exitosa.";
    // Send email.
    mail($mail, "Subscripción a Newsletter", $msg);

    $to = $mail;
    $subject = "Subscripción a Newsletter";

    $message = "
    <html>
    <head>
    <title>HTML email</title>
    </head>
    <body>
    <h1>¡Felicidades " . $name . "!</h1>
    <p>Ha sido subscrito a Newsletter de manera exitosa.</p>
    </table>
    </body>
    </html>";

    // Always set content-type when sending HTML email.
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    mail($to, $subject, $message, $headers);
  }
}
