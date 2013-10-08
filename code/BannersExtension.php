<?php

class BannersExtension extends DataExtension{
	
	static $has_many = array(
		'Banners' => 'BannerImage'
	);

	public function updateCMSFields(FieldList $fields){
		$fields->addFieldsToTab("Root.Banners",
			GridField::create("Banners",null,$this->owner->Banners(),
				GridFieldConfig_RecordEditor::create()
			)
		);
	}

}