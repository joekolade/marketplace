<?php
namespace JS\Marketplace\Utility;

/**
 * MigrationHelper
 */
class MigrationHelper
{

    protected $productGroupsToCategories;

    protected $productGroupsToOptions;

    protected $productSubGroupsToOptions;

    function __construct()
    {
        // Todo: Mappings für Migration

        $this->productGroupsToCategories = Array(
            1 => 1,     // Power kits           =>
            2 => 2,     // Solar lanterns       =>
            14 => 14,   // SHS 12V              =>
            16 => 16,   // LED                  =>
            17 => 17,   // Fans                 =>
            24 => 24,   // Various appliances   =>
            18 => 18,   // Fridges              =>
            19 => 19,   // Pumps                =>
            20 => 20,   // Radios               =>
            21 => 21,   // TV                   =>
            25 => 25,   // PAYG (component)     =>
            26 => 26,   // SHS  <12V            =>
        );

        $this->productGroupsToOptions = Array(

        );

        $this->productSubGroupsToOptions = Array(
            14 => 14,   // 21Wp - 50Wp          =>
            15 => 15,   // 1Wp - 20Wp           =>
            16 => 16,   // 51Wp -100Wp          =>
            17 => 17,   // Table                =>
            18 => 18,   // Ceiling              =>
            19 => 19,   // < 1W                 =>
            20 => 20,   // 1W                   =>
            21 => 21,   // 2W                   =>
            22 => 22,   // 3W                   =>
            23 => 23,   // 4W                   =>
            24 => 24,   // 5W                   =>
            25 => 25,   // > 5W                 =>
            26 => 26,   // up to 20''           =>
            27 => 27,   // > 20''               =>
            //28 => 28, // Cloth dryers         =>
            29 => 29,   // Egg incubators       =>
            30 => 30,   // Electric fences      =>
            31 => 31,   // Hand drills          =>
            32 => 32,   // Kettles              =>
            33 => 33,   // Sewing machines      =>
            //34 => 34, // Spinning wheels      =>
            35 => 35,   // Washing machines     =>
            36 => 36,   // > 100Wp              =>
            37 => 37,   // Stand                =>
            38 => 38,   // Surface              =>
            39 => 39,   // Submersible          =>
            40 => 40,   // Portable             =>
            41 => 41,   // Iron                 =>
            42 => 42,   // Hair dryer           =>
            43 => 43,   // Mosquito repellent   =>
            44 => 44,   // Cooker/Stove         =>
            45 => 45,   // <12V                 =>
            46 => 46,   // 12V                  =>
            47 => 47,   // 24V                  =>
            48 => 48,   // 48V                  =>
            49 => 49,   // Refrigerators/Freezers   =>
            50 => 50,   // Medical Fridges/Freezers =>
            51 => 51,   // Mobile/Portable      =>
            52 => 52,   // Refrigerators        =>
            53 => 53,   // Freezers             =>
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