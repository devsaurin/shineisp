<?php

/**
 * CmsPages
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    ShineISP
 * 
 * @author     Shine Software <info@shineisp.com>
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class CmsPages extends BaseCmsPages {
	
	/**
	 * grid
	 * create the configuration of the grid
	 */
	public static function grid($rowNum = 10) {
		$Session = new Zend_Session_Namespace ( 'Default' );
		$translator = Shineisp_Registry::getInstance ()->Zend_Translate;
		
		$config ['datagrid'] ['columns'] [] = array ('label' => null, 'field' => 'cms.page_id', 'alias' => 'page_id', 'type' => 'selectall' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'ID' ), 'field' => 'cms.page_id', 'alias' => 'page_id', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Title' ), 'field' => 'title', 'alias' => 'title', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Variable' ), 'field' => 'var', 'alias' => 'var', 'sortable' => true, 'searchable' => true, 'type' => 'string' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Date' ), 'field' => 'cms.publishedat', 'alias' => 'date', 'sortable' => true, 'searchable' => true, 'type' => 'date' );
		$config ['datagrid'] ['columns'] [] = array ('label' => $translator->translate ( 'Language' ), 'type' => 'arraydata', 'index' => 'page_id', 'alias'=>'dummy', 'run' => array('CmsPagesData'=>'getTranslations') );
		$config ['datagrid'] ['fields'] = "cms.page_id, DATE_FORMAT(cms.publishedat, '%d/%m/%Y') as date, cms.title, cms.var";
		$config ['datagrid'] ['rownum'] = $rowNum;
		
		$config ['datagrid'] ['dqrecordset'] = Doctrine_Query::create ()->select ( $config ['datagrid'] ['fields'] )
																		->from ( 'CmsPages cms' );
		
		
		$config ['datagrid'] ['basepath'] = "/admin/cmspages/";
		$config ['datagrid'] ['index'] = "page_id";
		$config ['datagrid'] ['rowlist'] = array ('10', '50', '100', '1000' );
		
		$config ['datagrid'] ['buttons'] ['edit'] ['label'] = $translator->translate ( 'Edit' );
		$config ['datagrid'] ['buttons'] ['edit'] ['cssicon'] = "edit";
		$config ['datagrid'] ['buttons'] ['edit'] ['action'] = "/admin/cmspages/edit/id/%d";
		
		$config ['datagrid'] ['buttons'] ['delete'] ['label'] = $translator->translate ( 'Delete' );
		$config ['datagrid'] ['buttons'] ['delete'] ['cssicon'] = "delete";
		$config ['datagrid'] ['buttons'] ['delete'] ['action'] = "/admin/cmspages/delete/id/%d";
		$config ['datagrid'] ['massactions']['common'] = array ('massdelete' => 'Mass Delete');
		return $config;
	}
	
	/**
	 * find
	 * Get a record by ID
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function find($id) {
		return Doctrine::getTable ( 'CmsPages' )->findOneBy ( 'page_id', $id );
	}
	
	/**
	 * getParent
	 * Get all the parent of the record selected by ID
	 * @param $id
	 * @return Doctrine Record
	 */
	public static function getParent($id, $locale) {
		return Doctrine_Query::create ()->from ( 'CmsPages cms' )
										->leftJoin ( 'cms.CmsPagesData cpd' )
										->leftJoin ( 'cpd.Languages l' )
										->where ( 'l.code = ?', $locale )
										->andWhere ( 'cms.parent_id = ?', $id )
										->andWhere ( 'cms.showinmenu = ?', 1 )
										->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
	}
	
	/**
	 * getpages
	 * Get all the active cms pages records
	 * @return Array
	 */
	public static function getpages($locale = "en") {
		$dq = Doctrine_Query::create ()->from ( 'CmsPages cms' )
								->leftJoin ( 'cms.CmsPagesData cpd' )
								->leftJoin ( 'cpd.Languages l' )
								->where ( 'l.code = ?', $locale )
								->addWhere('cms.active = ?', 1);
		return $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
	}
	
	/**
	 * Get all the active blog pages records
	 * @return Array
	 */
	public static function getblogpages($locale = "en") {
		$dq = Doctrine_Query::create ()->from ( 'CmsPages cms' )
								->leftJoin ( 'cms.CmsPagesData cpd' )
								->leftJoin ( 'cpd.Languages l' )
								->where ( 'l.code = ?', $locale )
								->addWhere ( 'cms.blog = ?', 1 )
								->addWhere('cms.active = ?', 1);
		return $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
	}
	
	/**
	 * getRsspages
	 * Get all the pages published on RSS feed
	 * @return Array
	 */
	public static function getRssPages($locale = "en") {
		$dq = Doctrine_Query::create ()->from ( 'CmsPages cms' )
									   ->leftJoin ( 'cms.CmsPagesData cpd' )
									   ->leftJoin ( 'cpd.Languages l' )
									   ->where ( 'l.code = ?', $locale )
									   ->addWhere('cms.showonrss = ?', 1)
									   ->addWhere('cms.active = ?', 1);
		return $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
	}
	
	/**
	 * findbyvar
	 * Get a record by Var
	 * @param $var
	 * @return array
	 */
	public static function findbyvar($var, $locale = "en") {
		$record = Doctrine_Query::create ()->from ( 'CmsPages cms' )
										   ->leftJoin ( 'cms.CmsPagesData cpd' )
										   ->leftJoin ( 'cpd.Languages l' )
										   ->where ( 'l.code = ?', $locale )
										   ->andWhere ( 'cms.var = ?', $var )
										   ->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		
		if (! empty ( $record [0] )) {
			$record[0]['body'] = Shineisp_Commons_Contents::chkModule($record[0]['body']);
			$record [0] ['body'] = Shineisp_Commons_Contents::chkCmsBlocks ( $record [0] ['body'], $locale );
			return $record [0];
		} else {
			return false;
		}
	}
	
	/**
	 * delete
	 * Delete a record by ID
	 * @param $id
	 */
	public static function deleteItem($id) {
		
		if(is_numeric($id)){
			$record = Doctrine_Query::create ()
											->from ( 'CmsPages cms' )
											->where('cms.page_id = ?', $id)
											->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
			if($record){
				Doctrine::getTable ( 'CmsPages' )->findOneBy ( 'page_id', $id )->delete ();
				return true;
			}
		}
		
		return false;
	}
	
	/*
     * getList
     * get the pages list 
     */
	public static function getList($empty = false, $locale=1) {
		$items = array ();
		
		if ($empty) {
			$items [] = "";
		}
		
		$records = Doctrine_Query::create ()->select ( "cms.page_id, cms.title as title" )
										->from ( 'CmsPages cms' )
										->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
										
		foreach ( $records as $c ) {
			$items [$c ['page_id']] = $c ['title'];
		}
		
		return $items;
	}
	
	/**
	 * Get Content Layouts templates
	 */
	public static function getLayouts() {
		$items = array ();
		
		$customskin = Settings::findbyParam ( 'skin' );
		$skin = !empty ( $customskin ) ? $customskin : "base";
	
		$files = Shineisp_Commons_Utilities::getDirectoryList(PUBLIC_PATH . "/skins/default/$skin/scripts/cms/");
		
		foreach ( $files as $file ) {
			if(strpos($file, ".phtml")){
				$filename = basename($file);
				$name = str_replace(".phtml", "", $filename);
				$items [$name] = $name;
			}
		}
		
		return $items;
	}
	
	/**
	 * Get the page layouts templates
	 */
	public static function getPageLayouts() {
		$items = array ();
		
		$customskin = Settings::findbyParam ( 'skin' );
		$skin = !empty ( $customskin ) ? $customskin : "base";
	
		$files = Shineisp_Commons_Utilities::getDirectoryList(PUBLIC_PATH . "/skins/default/$skin/scripts/");
		$items[] = "";
		
		foreach ( $files as $file ) {
			if(strpos($file, ".phtml")){
				$filename = basename($file);
				$name = str_replace(".phtml", "", $filename);
				$items [$name] = $name;
			}
		}
		
		return $items;
	}
	
	
	
	/**
	 * Get all data starting from the wikiID 
	 * 
	 * 
	 * @param $id
	 * @return Doctrine Record / Array
	 */
	public static function getAllInfo($id) {
		
		if(!is_numeric($id)){
			return array();
		}
		
		$dq = Doctrine_Query::create ()->select ( "page_id, 
												   cms.title as title, 
												   DATE_FORMAT(cms.publishedat, '%d/%m/%Y') as publishedat, 
												   cms.*,
												   cpd.language_id" )
										->from ( 'CmsPages cms' )
										->leftJoin ( 'cms.CmsPagesData cpd' )
										->leftJoin ( 'cpd.Languages l' )
										->addWhere ( "page_id = ?", $id )
										->limit ( 1 );
		
		$records = $dq->execute ( array (), Doctrine_Core::HYDRATE_ARRAY );
		
		// Get the languages
		if(!empty($records[0]['CmsPagesData'])){
			foreach ($records[0]['CmsPagesData'] as $record) {
				$records[0]['language_id'][] = $record['language_id'];
			}
			unset($records[0]['CmsPagesData']);
		}
		
		return !empty($records[0]) ? $records[0] : array();
	}
	

	/**
	 * delete the pages selected 
	 * @param array
	 * @return Boolean
	 */
	public static function massdelete($items) {
		$retval = Doctrine_Query::create ()->delete ()->from ( 'CmsPagesData' )->whereIn ( 'page_id', $items )->execute ();
		$retval = Doctrine_Query::create ()->delete ()->from ( 'Cmspages' )->whereIn ( 'page_id', $items )->execute ();
		return $retval;
	}	
	
	/**
	 * 
	 * Save the Cms page data
	 */
	public static function saveAll($id, $params, $locale = 1) {
		$i = 0;
		
		// Set the new values
		if (is_numeric ( $id )) {
			$cmspages = Doctrine::getTable ( 'Cmspages' )->find ( $id );
		} else {
			$cmspages = new CmsPages();
			$cmspages->publishedat = date('Y-m-d H:i:s');
		}
		
		$cmspages->title = $params['title'];
		$cmspages->body = $params['body'];
		$cmspages->keywords = $params['keywords'];
		$cmspages->blocks = $params['blocks'];
		$cmspages->layout = $params ['layout'];
		$cmspages->xmllayout = $params ['xmllayout'];
		$cmspages->var = !empty($params ['var']) ? Shineisp_Commons_UrlRewrites::format($params ['var']) : Shineisp_Commons_UrlRewrites::format($params ['title']);
		$cmspages->pagelayout = $params ['pagelayout'];
		$cmspages->parent_id = $params ['parent_id'];
		$cmspages->showinmenu = $params ['showinmenu'] ? true : false;
		$cmspages->showonrss = $params ['showonrss'] ? true : false;
		$cmspages->blog = $params ['blog'] ? true : false;
		$cmspages->showonrss = $params ['showonrss'] ? true : false;
		$cmspages->active = $params ['active'] ? true : false;
		
		if($cmspages->trySave ()){
			if(is_numeric($cmspages['page_id'])){
				
				// Clear old reference records by page_id
				CmsPagesData::deleteItems($cmspages['page_id']);
				
				// Save the page translation references
				$PageData = new Doctrine_Collection('CmsPagesData');
				foreach ($params['language_id'] as $idlang) {
					$PageData[$i]->page_id = $cmspages['page_id'];
					$PageData[$i]->language_id = $idlang;
					$i++;
				}
				$PageData->save();
			}
		}
		
		$id = is_numeric ( $id ) ? $id : $cmspages->getIncremented ();
		
		return $id;
	}

	######################################### BULK ACTIONS ############################################
	
	/**
	 * massdelete
	 * delete the pages selected 
	 * @param array
	 * @return Boolean
	 */
	public static function bulk_delete($items) {
		if(!empty($items)){
			return self::massdelete($items);
		}
		return false;
	}	
}
