<?php
class Admin_Form_DomainstldsForm extends Zend_Form
{   
    public function init()
    {
        // Set the custom decorator
    	$this->addElementPrefixPath('Shineisp_Decorator', 'Shineisp/Decorator/', 'decorator');
    	$translate = Shineisp_Registry::get('Zend_Translate');
    	
        $this->addElement('text', 'name', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('TLD Name'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));
    	
        $this->addElement('textarea', 'description', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Description'),
            'decorators' => array('Composite'),
            'class'      => 'textarea large-input wysiwyg',
            'rows'      => '5'
        ));
    	
        $this->addElement('text', 'tags', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Tags/Type'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));
        
        $this->addElement('select', 'ishighlighted', array(
            'label'      => $translate->_('Is Highlighted'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input',
            'multioptions' => array('0' => 'No', '1'=>'Yes')
        ));

        $this->addElement('select', 'isrefundable', array(
            'label'      => $translate->_('Is Refundable'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input',
            'multioptions' => array('0' => 'No', '1'=>'Yes')
        ));
        
        $this->addElement('text', 'resultcontrol', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Result String Control'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));

        $this->addElement('text', 'registration_price', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Registration Price'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        

        $this->addElement('text', 'renewal_price', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Renewal Price'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        

        $this->addElement('text', 'transfer_price', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Transfer Price'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        

        $this->addElement('select', 'server_id', array(
            'decorators'  => array('Composite'),
            'label'       => $translate->_('TLD Server'),
            'class'       => 'text-input large-input'
        ));
                
        $this->getElement('server_id')
                  ->setAllowEmpty(false)
                  ->setRegisterInArrayValidator(false)
                  ->setMultiOptions(WhoisServers::getList()); 
                  
       $this->addElement('select', 'tax_id', array(
        'label' => $translate->_('Tax'),
        'decorators' => array('Composite'),
        'class'      => 'text-input large-input'
        ));
        
        $this->getElement('tax_id')
                  ->setAllowEmpty(false)
                  ->setMultiOptions(Taxes::getList(true));                        
        
        $this->addElement('text', 'registration_cost', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Registration Cost'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        

        $this->addElement('text', 'renewal_cost', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Renewal Cost'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        

        $this->addElement('text', 'transfer_cost', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Transfer Cost'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));        
        
        $this->addElement('select', 'registrars_id', array(
                'label' => $translate->_('Registrars'),
                'decorators' => array('Composite'),
                'class'      => 'text-input large-input updatechkdomain'
        ));
        
        $this->getElement('registrars_id')
                  ->setAllowEmpty(false)
                  ->setMultiOptions(Registrars::getList())
                  ->setRequired(true);        
        
        $this->addElement('submit', 'save', array(
            'required' => false,
            'label'    => $translate->_('Save'),
            'decorators' => array('Composite'),
            'class'    => 'button'
        ));
        
        $this->addElement('hidden', 'tld_id');
    }
}