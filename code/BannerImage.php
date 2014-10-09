<?php

class BannerImage extends DataObject{

	private static $db = array(
		'Title' => 'Varchar(255)',
		'SubTitle' => 'Varchar(255)',
		'Link' => 'LinkField',
		'Sort' => 'Int'
	);

	private static $has_one = array(
		'Image' => 'Image',
		'Parent' => 'Page'
	);

	private static $summary_fields = array(
		'Image.CMSThumbnail' => 'Image',
		'CMSTitle' => 'Title',
		'Link' => 'Link'
	);

	private static $default_sort = "\"Sort\" ASC, \"ID\" ASC";

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$image = $fields->fieldByName('Root.Main.Image');
		$fields->removeByName('Image');
		$fields->insertBefore($image,'Title');
		$fields->removeByName('ParentID');
		$fields->removeByName('Sort');
		return $fields;
	}

	function getCMSTitle(){
		if($this->Title){
			return $this->Title;
		}
		if($this->Image()){
			return $this->Image()->Title;
		}
	}

	public function canCreate($member = null) {
		return Permission::check("CMS_ACCESS_CMSMain");
	}

	public function canEdit($member = null) {
		return Permission::check("CMS_ACCESS_CMSMain");
	}

	public function canDelete($member = null) {
		return Permission::check("CMS_ACCESS_CMSMain");
	}

	public function canView($member = null) {
		return Permission::check("CMS_ACCESS_CMSMain");
	}

}