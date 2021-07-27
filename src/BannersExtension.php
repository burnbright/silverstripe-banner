<?php

namespace Burnbright\SilverstripeBanner;

use BannerImage;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\GridField\GridField;
use Symbiote\GridFieldExtensions\GridFieldOrderableRows;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class BannersExtension extends DataExtension
{
    
    public static $has_many = array(
        'Banners' => BannerImage::class
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
