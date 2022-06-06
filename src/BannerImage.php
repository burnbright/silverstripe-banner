<?php

namespace Burnbright\SilverstripeBanner;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\TreeDropdownField;
use Page;

class BannerImage extends DataObject
{

    private static $table_name = "BannerImage";

    private static $db = array(
        'Title' => 'Varchar(255)',
        'SubTitle' => 'Varchar(255)',
        'Sort' => 'Int'
    );

    private static $has_one = array(
        'Image' => Image::class,
        'Parent' => Page::class,
        'Link' => SiteTree::class,
    );

    private static $summary_fields = array(
        'Image.CMSThumbnail' => 'Image',
        'CMSTitle' => 'Title',
        'Link.Title' => 'Link'
    );

    private static $default_sort = "\"Sort\" ASC, \"ID\" ASC";

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $image = $fields->fieldByName('Root.Main.Image');
        $fields->removeByName('Image');
        $fields->insertBefore($image, 'Title');
        $fields->removeByName('ParentID');
        $fields->removeByName('Sort');

        $fields->replaceField(
        	'LinkID',
        	TreeDropdownField::create(
        		'LinkID',
        		'Link',
        		SiteTree::class
        	)
        );

        return $fields;
    }

    public function getCMSTitle()
    {
        if ($this->Title) {
            return $this->Title;
        }
        if ($this->Image()) {
            return $this->Image()->Title;
        }
    }

    public function canCreate($member = null, $context = [])
    {
        return Permission::check("CMS_ACCESS_CMSMain");
    }

    public function canEdit($member = null, $context = [])
    {
        return Permission::check("CMS_ACCESS_CMSMain");
    }

    public function canDelete($member = null, $context = [])
    {
        return Permission::check("CMS_ACCESS_CMSMain");
    }

    public function canView($member = null, $context = [])
    {
        return Permission::check("CMS_ACCESS_CMSMain");
    }
}
