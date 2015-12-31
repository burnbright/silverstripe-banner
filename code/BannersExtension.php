<?php

class BannersExtension extends DataExtension
{
    
    public static $has_many = array(
        'Banners' => 'BannerImage'
    );

    public function updateCMSFields(FieldList $fields)
    {
        $fields->addFieldsToTab("Root.Banners",
            GridField::create("Banners", null, $this->owner->Banners(),
                $config = GridFieldConfig_RecordEditor::create()
            )
        );
        if (class_exists("GridFieldOrderableRows")) {
            $config->addComponent(new GridFieldOrderableRows());
        }
    }

    public function getFirstBanner()
    {
        return $this->owner->Banners()->first();
    }

    public function getRandomBanner()
    {
        return $this->owner->Banners()->sort("RAND()")->first();
    }
}
