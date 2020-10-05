<?php

// link interes: https://devdocs.prestashop.com/1.7/webservice/resources/cart_rules/
//link interes 2: https://devdocs.prestashop.com/1.7/webservice/resources/order_cart_rules/
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

        $helper->submit_action = 'modulo4';
        $helper->fields_value['texto'] = Configuration::get('MODULO 4');
        
        $this->form[0] = array(
            'form' => array(
                'legend' => array(
                    'title' => $this->displayName
                 ),
                 /*ESTE ES EL INPUT DONDE SE ESPECIFICARÁ CUANTO DEBE GASTAR EL CLIENTE PARA RECIBIR EL CUPÓN*/
                'input' => array(
                    array(
                        'type' => 'float',
                        'label' => $this->l('Cantidad_minima_gasto'),
                        'desc' => $this->l('Cantidad mínima para generar cupón descuento'),
                        'name' => 'Cantidad_minima_gasto',
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

// para tabla: 
/* en plantilla de config (a la que dirige el get content) meter una tabla con las variables que pide ($lastname, $firstname... de ps_customer y ps_order)
en principio, no hace falta hook, pues al estar dentro del get content saldra en la configuración del modulo
a parte de esta tabla, hay que poner el input para definir la cantidad de gasto necesaria para generar el cupón (cantidad minima gasto)*/

/*cantidad necesaria para generar cupon*/

public function defineDiscount()
{
    $gasto = SELECT SUM `total_paid_real`, FROM '._DB_PREFIX_.'order `.... 
        //foreach id_customer? (igual que lo que se puso al general el descuento en el otro archivo, para que haya solo uno por customer)
    ...
        
        if ($cantidad_minima_gasto >= $gasto ) {
        $discount=1;
        else $discount=0;
        }
    //1=descuento, 0=no genera descuento
}

