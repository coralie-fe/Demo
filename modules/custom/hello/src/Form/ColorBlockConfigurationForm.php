<?php
/**
 * @file
 * Contains \Drupal\hello\Form\ColorBlockConfigurationForm.
 */
namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements an cinfiguration color block form
 * formulaire admin pour choisir la couleur qui sera utilisé pour les blocs
 */
class ColorBlockConfigurationForm extends ConfigFormBase{

    /**
     * {@inheritdoc}
     */
    public function getFormID(){
        return 'Hello_admin_form';
    }

    public function getEditableConfigNames()
    {
        // TODO: Implement getEditableConfigNames() method.
        return['hello.config'];
    }

    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // TODO: Implement buildForm() method.
        $color_selected = $this->config('hello.config')->get('color');
        //kint($color_selected);
        $form['select_color'] = [
            '#type' => 'select',
            '#title' => t('Blocks color'),
            '#default_value' => $color_selected,
            '#options' => [
                'green-class' => 'Green',
                'orange-class' => 'Orange',
                'blue-class' => 'Blue',
            ],
        ];
        return parent::buildForm($form, $form_state);
    }

    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        // TODO: Implement submitForm() method.

        $select_color = $form_state->getValue('select_color');
        $this->config('hello.config')->set('color',$select_color)->save();

        parent::submitForm($form, $form_state);

    }



}