<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('ServersTypes', 'doctrine');

/**
 * BaseServersTypes
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $type_id
 * @property string $type
 * @property Doctrine_Collection $Servers
 * 
 * @package    ShineISP
 * 
 * @author     Shine Software <info@shineisp.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseServersTypes extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('servers_types');
        $this->hasColumn('type_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             'fixed' => false,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('type', 'string', 200, array(
             'type' => 'string',
             'length' => 200,
             'fixed' => false,
             'unsigned' => false,
             'primary' => false,
             'notnull' => true,
             'autoincrement' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Servers', array(
             'local' => 'type_id',
             'foreign' => 'type_id'));
    }
}