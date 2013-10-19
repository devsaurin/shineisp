<?php
class Default_Form_OrdersForm extends Zend_Form
{
    
    public function init()
    {
    	// Set the custom decorator
        $this->addElementPrefixPath('Shineisp_Decorator', 'Shineisp/Decorator/', 'decorator');
        $translate = Shineisp_Registry::get('Zend_Translate');
        
        $this->addElement('textarea', 'note', array(
            'filters'     => array('StringTrim'),
            'required'    => false,
            'decorators'  => array('Composite'),
            'rows'       => '10',
            'description' => $translate->_('Write here your reply. An email will be sent to the ISP staff.'),
            'class'       => 'textarea wysiwyg'
        ));
        
        $this->addElement('submit', 'save', array(
            'required' => false,
            'label'      => $translate->_('Save'),
            'decorators' => array('Composite'),
            'class'    => 'button'
        ));
        
        $id = $this->addElement('hidden', 'order_id');

    }
    
}