<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('CustomersGroups', 'doctrine');

/**
 * BaseCustomersGroups
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $group_id
 * @property string $name
 * @property integer $isp_id
 * @property Customers $Customers
 * @property Isp $Isp
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseCustomersGroups extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('customers_groups');
        $this->hasColumn('group_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 250, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '250',
             ));
        $this->hasColumn('isp_id', 'integer', 4, array(
             'type' => 'integer',
             'default' => 1,
             'notnull' => true,
             'length' => '4',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Customers', array(
             'local' => 'group_id',
             'foreign' => 'group_id'));

        $this->hasOne('Isp', array(
             'local' => 'isp_id',
             'foreign' => 'isp_id'));
    }
}