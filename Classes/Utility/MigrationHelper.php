<?php
namespace JS\Marketplace\Utility;

/**
 * MigrationHelper
 */
class MigrationHelper
{

    protected $productGroupsToCategories;

    protected $productGroupsToOptions;

    protected $productSubGroupsToCategories;

    protected $productSubGroupsToOptions;


    function __construct()
    {
        // Todo: Mappings für Migration

        /*
         * Categories
            Solar-Home-Systems = 1
            Solar Power Systems = 2
            Appliances = 3
            Light = 4
            Components = 5
            Panels = 6
            Batteries = 7
         */
        /*
         * Options
            TODO: Options erweitern (DB/TYPO3)
         */
        $this->productGroupsToCategories = Array(
            1 => 2,     // Power kits           =>  Solar Power Systems
            2 => 4,     // Solar lanterns       =>  Light
            14 => 1,    // SHS 12V              =>  Solar-Home-Systems
            16 => 4,    // LED                  =>  Light
            17 => 3,    // Fans                 =>  Appliances
            18 => 3,    // Fridges              =>  Appliances
            19 => 3,    // Pumps                =>  Appliances
            24 => 3,    // Various appliances   =>  Appliances
            20 => 3,    // Radios               =>  Appliances
            21 => 3,    // TV                   =>  Appliances
            25 => 0,    // PAYG (component)     =>  n/a
            26 => 1,    // SHS  <12V            =>  Solar-Home-Systems
        );

        $this->productGroupsToOptions = Array(
            1 => 2,     // Power kits           =>
            2 => 4,     // Solar lanterns       =>  Light
            14 => 1,    // SHS 12V              =>  Solar-Home-Systems
            16 => 4,    // LED                  =>  Light
            17 => 3,    // Fans                 =>  Appliances
            18 => 3,    // Fridges              =>  Appliances
            19 => 3,    // Pumps                =>  Appliances
            24 => 3,    // Various appliances   =>  Appliances
            20 => 3,    // Radios               =>  Appliances
            21 => 3,    // TV                   =>  Appliances
            25 => 0,    // PAYG (component)     =>  n/a
            26 => 1,    // SHS  <12V            =>  Solar-Home-Systems
        );

        $this->productSubGroupsToCategories = Array(

        $this->productSubGroupsToOptions = Array(
            14 => 0,    // 21Wp - 50Wp          =>
            15 => 0,    // 1Wp - 20Wp           =>
            16 => 0,    // 51Wp -100Wp          =>
            17 => 0,    // Table                =>
            18 => 0,    // Ceiling              =>
            19 => 0,    // < 1W                 =>
            20 => 0,    // 1W                   =>
            21 => 0,    // 2W                   =>
            22 => 0,    // 3W                   =>
            23 => 0,    // 4W                   =>
            24 => 0,    // 5W                   =>
            25 => 0,    // > 5W                 =>
            26 => 0,    // up to 20''           =>
            27 => 0,    // > 20''               =>
            //28 => 0,  // Cloth dryers         =>
            29 => 0,    // Egg incubators       =>
            30 => 0,    // Electric fences      =>
            31 => 0,    // Hand drills          =>
            32 => 0,    // Kettles              =>
            33 => 0,    // Sewing machines      =>
            //34 => 0,  // Spinning wheels      =>
            35 => 0,    // Washing machines     =>
            36 => 0,    // > 100Wp              =>
            37 => 0,    // Stand                =>
            38 => 0,    // Surface              =>
            39 => 0,    // Submersible          =>
            40 => 0,    // Portable             =>
            41 => 0,    // Iron                 =>
            42 => 0,    // Hair dryer           =>
            43 => 0,    // Mosquito repellent   =>
            44 => 0,    // Cooker/Stove         =>
            45 => 0,    // <12V                 =>
            46 => 0,    // 12V                  =>
            47 => 0,    // 24V                  =>
            48 => 0,    // 48V                  =>
            49 => 0,    // Refrigerators/Freezers   =>
            50 => 0,    // Medical Fridges/Freezers =>
            51 => 0,    // Mobile/Portable      =>
            52 => 0,    // Refrigerators        =>
            53 => 0,    // Freezers             =>
        );
    }

    public function migrateData()
    {

        // Todo: Migration - 1. Clear data

        // Todo: Migration - 2. productgroup => category

        // Todo: Migration - 3. productgroup/productsubgroups => options

        return false;
    }

}