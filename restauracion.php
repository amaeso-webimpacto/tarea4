<?php


// link web https://urimarti.com/tutoriales-prestashop/crear-un-modulo-parte-1/ 
//para la parte del input ver también: http://doc.prestashop.com/display/PS16/Using+the+HelperForm+class
public function postProcess()
    {
        if (Tools::isSubmit('modulo4')) {
            $texto = Tools::getValue('texto');
            Configuration::updateValue('MODULO 4 HOME', $texto);
            return $this->displayConfirmation($this->l('Updated Successfully'));
        }
    }
   
  
   public function getForm()
    {
        $helper = new HelperForm();
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->identifier = $this->identifier;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->languages = $this->context->controller->getLanguages();
        $helper->currentIndex = AdminController::$currentIndex . '&configure=' . $this->name;
        $helper->default_form_language = $this->context->controller->default_form_language;
        $helper->allow_employee_form_lang = $this->context->controller->allow_employee_form_lang;
        $helper->title = $this->displayName;

        $helper->submit_action = 'urimodulo';
        $helper->fields_value['texto'] = Configuration::get('URI_MODULO_TEXTO_HOME');
        
        $this->form[0] = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->displayName
                 ),
                 /*ESTE ES EL INPUT DONDE SE ESPECIFICARÁ CUANTO DEBE GASTAR EL CLIENTE PARA RECIBIR EL CUPÓN*/
                'input' => array(
                    array(
                        'type' => 'float',
                        'label' => $this->l('Discount'),
                        'desc' => $this->l('Cantidad mínima para generar cupón descuento'),
                        'name' => 'discount',
                        'lang' => false,
                     ),
                 ),
                'submit' => array(
                    'title' => $this->l('Save')
                 )
             )
         );
        return $helper->generateForm($this->form);
    }
