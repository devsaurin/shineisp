<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('PanelsActions', 'doctrine');

/**
 * BasePanelsActions
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $action_id
 * @property integer $panel_id
 * @property integer $customer_id
 * @property integer $orderitem_id
 * @property timestamp $start
 * @property string $action
 * @property integer $status_id
 * @property timestamp $end
 * @property string $parameters
 * @property string $log
 * @property Panels $Panels
 * @property Statuses $Statuses
 * @property Customers $Customers
 * @property OrdersItems $OrdersItems
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePanelsActions extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('panels_actions');
        $this->hasColumn('action_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('panel_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('customer_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('orderitem_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('start', 'timestamp', 25, array(
             'type' => 'timestamp',
             'notnull' => true,
             'length' => '25',
             ));
        $this->hasColumn('action', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('status_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'length' => '4',
             ));
        $this->hasColumn('end', 'timestamp', 25, array(
             'type' => 'timestamp',
             'length' => '25',
             ));
        $this->hasColumn('parameters', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
        $this->hasColumn('log', 'string', null, array(
             'type' => 'string',
             'length' => '',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Panels', array(
             'local' => 'panel_id',
             'foreign' => 'panel_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Statuses', array(
             'local' => 'status_id',
             'foreign' => 'status_id'));

        $this->hasOne('Customers', array(
             'local' => 'customer_id',
             'foreign' => 'customer_id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('OrdersItems', array(
             'local' => 'orderitem_id',
             'foreign' => 'detail_id',
             'onDelete' => 'CASCADE'));
    }
}