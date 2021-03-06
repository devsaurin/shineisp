<?php
// Connection Component Binding
Doctrine_Manager::getInstance()->bindComponent('Panels', 'doctrine');

/**
 * BasePanels
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $panel_id
 * @property string $name
 * @property integer $isp_id
 * @property boolean $active
 * @property Isp $Isp
 * @property Doctrine_Collection $PanelsActions
 * @property Doctrine_Collection $Servers
 * 
 * @package    ##PACKAGE##
 * @subpackage ##SUBPACKAGE##
 * @author     ##NAME## <##EMAIL##>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasePanels extends Doctrine_Record
{
    public function setTableDefinition()
    {
        $this->setTableName('panels');
        $this->hasColumn('panel_id', 'integer', 4, array(
             'type' => 'integer',
             'fixed' => 0,
             'unsigned' => false,
             'primary' => true,
             'autoincrement' => true,
             'length' => '4',
             ));
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
        $this->hasColumn('isp_id', 'integer', 4, array(
             'type' => 'integer',
             'notnull' => true,
             'default' => 1,
             'length' => '4',
             ));
        $this->hasColumn('active', 'boolean', 25, array(
             'type' => 'boolean',
             'length' => '25',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Isp', array(
             'local' => 'isp_id',
             'foreign' => 'isp_id'));

        $this->hasMany('PanelsActions', array(
             'local' => 'panel_id',
             'foreign' => 'panel_id'));

        $this->hasMany('Servers', array(
             'local' => 'panel_id',
             'foreign' => 'panel_id'));
    }
}