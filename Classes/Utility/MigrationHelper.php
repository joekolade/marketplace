<?php
namespace JS\Marketplace\Utility;


/**
 * MigrationHelper
 */
class MigrationHelper
{

    /*
     * @var array
     */
    protected $productGroupsToCategories;

    /*
     * @var array
     */
    protected $productSubGroupsToOptions;

    function __construct()
    {
        /*
         * Productgroups => Categories
         */
        $this->productGroupsToCategories = Array(
            1 => 1,     // Power kits           =>  Systems
            2 => 3,     // Solar lanterns       =>  Light
            14 => 1,    // SHS 12V              =>  Systems
            16 => 3,    // LED                  =>  Light
            17 => 2,    // Fans                 =>  Appliances
            18 => 2,    // Fridges              =>  Appliances
            19 => 2,    // Pumps                =>  Appliances
            24 => 2,    // Various appliances   =>  Appliances
            20 => 2,    // Radios               =>  Appliances
            21 => 2,    // TV                   =>  Appliances
            25 => 0,    // PAYG (component)     =>  n/a
            26 => 1,    // SHS  <12V            =>  Systems
        );

        /*
         * Productsubgroups => Options
         */
        $this->productSubGroupsToOptions = Array(
            14 => 23,    // 21Wp - 50Wp          =>
            15 => 23,    // 1Wp - 20Wp           =>
            16 => 24,    // 51Wp -100Wp          =>
            17 => 36,    // Table                =>
            18 => 37,    // Ceiling              =>
            19 => 79,    // < 1W                 =>
            20 => 80,    // 1W                   =>
            21 => 81,    // 2W                   =>
            22 => 82,    // 3W                   =>
            23 => 83,    // 4W                   =>
            24 => 84,    // 5W                   =>
            25 => 85,    // > 5W                 =>
            26 => 44,    // up to 20''           =>
            27 => 45,    // > 20''               =>
            //28 => 0,  // Cloth dryers         =>
            29 => 58,    // Egg incubators       =>
            30 => 59,    // Electric fences      =>
            31 => 60,    // Hand drills          =>
            32 => 61,    // Kettles              =>
            33 => 62,    // Sewing machines      =>
            //34 => 0,  // Spinning wheels      =>
            35 => 63,    // Washing machines     =>
            36 => 25,    // > 100Wp              =>
            37 => 35,    // Stand                =>
            38 => 41,    // Surface              =>
            39 => 40,    // Submersible          =>
            40 => 46,    // Portable             =>

            41 => 57,    // Iron                 =>
            42 => 56,    // Hair dryer           =>
            43 => 55,    // Mosquito repellent   =>
            44 => 54,    // Cooker/Stove         =>

            45 => 2,    // <12V                 =>
            46 => 3,    // 12V                  =>
            47 => 4,    // 24V                  =>
            48 => 5,    // 48V                  =>

            49 => 53,    // Refrigerators/Freezers   =>
            50 => 50,    // Medical Fridges/Freezers =>
            51 => 51,    // Mobile/Portable      =>
            52 => 52,    // Refrigerators        =>
            53 => 49,    // Freezers             =>
        );
    }

    /**
     * @return array
     */
    public function getProductGroupsToCategories()
    {
        return $this->productGroupsToCategories;
    }

    /**
     * @return array
     */
    public function getProductSubGroupsToOptions()
    {
        return $this->productSubGroupsToOptions;
    }



}