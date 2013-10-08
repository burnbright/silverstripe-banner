<?php

class BannerImage extends DataObject{

	private static $db = array(
		'Title' => 'Varchar(255)',
		'Link' => 'LinkField'
	);

	private static $has_one = array(
		'Image' => 'Image',
		'Parent' => 'Page'
	);

	private static $summary_fields = array(
		'Image.Title','Title', 'Link'
	);

	public function getCMSFields(){
		$fields = parent::getCMSFields();
		$image = $fields->fieldByName('Root.Main.Image');
		$fields->removeByName('Image');
		$fields->insertBefore($image,'Title');
		$fields->removeByName('ParentID');
		return $fields;
	}

}