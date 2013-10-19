<?php
class Admin_Form_PurchasesForm extends Zend_Form
{   
    public function init()
    {
        // Set the custom decorator
    	$this->addElementPrefixPath('Shineisp_Decorator', 'Shineisp/Decorator/', 'decorator');
    	$translate = Shineisp_Registry::get('Zend_Translate');
    	
    	$this->addElement('text', 'creationdate', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Date'),
            'title'      => $translate->_('eg: 01/11/2010'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input date'
        ));
    	
    	$this->addElement('text', 'expiringdate', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Expiry Date'),
            'title'      => $translate->_('eg: 01/11/2011'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input date'
        ));
    	
    	$this->addElement('text', 'paymentdate', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Payment Date'),
            'title'      => $translate->_('eg: 01/11/2010'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input date'
        ));
        
        $this->addElement('select', 'category_id', array(
            'label'      => $translate->_('Category'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));
        
        $this->getElement('category_id')
                  ->setAllowEmpty(false)
                  ->setMultiOptions(PurchaseCategories::getList());        
        
        $this->addElement('select', 'method_id', array(
            'label'      => $translate->_('Payment Method'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));
        
        $this->getElement('method_id')
                  ->setAllowEmpty(false)
                  ->setMultiOptions(PaymentsMethods::getList());        

    	$this->addElement('text', 'number', array(
            'filters'    => array('StringTrim'),
            'required'   => true,
            'label'      => $translate->_('Number'),
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));
        
        $this->addElement('text', 'company', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Company'),
            'required'   => true,
        	'title' => $translate->_('eg: Google inc.'),
            'decorators' => array('Composite'),
            'class'      => 'text-input large-input'
        ));
        
        $this->addElement('text', 'total_net', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Total Net'),
        	'required'   => true,	
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));
        
        $this->addElement('text', 'total_vat', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Total VAT'),
        	'required'   => true,
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));
        
        $this->addElement('text', 'total', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Total'),
        	'required'   => true,
            'decorators' => array('Composite'),
            'class'      => 'text-input little-input'
        ));
        
        $this->addElement('textarea', 'note', array(
            'filters'    => array('StringTrim'),
            'label'      => $translate->_('Note'),
            'decorators' => array('Composite'),
            'class'      => 'textarea little-input'
        ));
        
        // If the browser client is an Apple client hide the file upload html object
        if(false == Shineisp_Commons_Utilities::isAppleClient()){
        	
			$file = $this->createElement('file', 'document', array(
	            'label'      => $translate->_('Document'),
	            'description'      => $translate->_('Select the document to upload. Files allowed are (zip,rtf,doc,pdf)'),
	            'class'      => 'text-input large-input'
	        ));
	        
	        $file->addValidator ( 'Extension', false, 'zip,rtf,doc,pdf' );
	        $file->setValueDisabled(true);
	        $file->setRequired(false);
			$this->addElement($file);     
	                  
        }
        
        $this->addElement('select', 'status_id', array(
        'label' => $translate->_('Status'),
        'required' => true,
        'decorators' => array('Composite'),
        'class'      => 'text-input large-input'
        ));
        
        $this->getElement('status_id')
                  ->setAllowEmpty(false)
                  ->setMultiOptions(Statuses::getList('orders'));
        
        $this->addElement('hidden', 'purchase_id');
    }
}