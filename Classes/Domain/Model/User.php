<?php

namespace JS\Marketplace\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2016 Joe Schäfer <joe@schaefer-webentwicklung.de>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * User
 */
 
class User extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $firstName;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $lastName;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $username;

    /**
     * @var string
     * @validate NotEmpty, RegularExpression(regularExpression = '/^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[A-Z])(?=\S*[\d])\S*$/')
     */
    protected $password;

    /**
     * @var string
     * @validate NotEmpty
     */
    protected $confirmpassword;

    /**
     * @var string
     * @validate NotEmpty
     * @validate EmailAddress
     * @validate \JS\Marketplace\Validation\Validator\UserExistsValidator
     */
    protected $email;

    /**
     * @var int
     */
    protected $gender;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var int
     * @validate NotEmpty
     */
    protected $legals = 0;

    /**
     * disable 
     * 
     * @var boolean 
     */
    protected $disable = 1;

    /**
     * pid 
     * 
     * @var integer
     */
    protected $pid;

    /**
     * Gets the Criteria 2.
     *
     * @return integer
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Sets the Criteria 1.
     *
     * @param integer $pid the pid
     * @return void
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
    }

    /**
     * Gets the value of gender.
     *
     * @return int
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets the value of gender.
     *
     * @param int $gender the gender
     *
     * @return self
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Gets the value of hash.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Sets the value of hash.
     *
     * @param string $hash the hash
     *
     * @return self
     */
    public function setHash($hash)
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * Gets the value of legals.
     *
     * @return int
     */
    public function getLegals()
    {
        return $this->legals;
    }

    /**
     * Sets the value of legals.
     *
     * @param int $legals the legals
     *
     * @return self
     */
    public function setLegals($legals)
    {
        $this->legals = $legals;

        return $this;
    }

    /** 
     * Returns disable 
     * 
     * @return boolean $disable 
     */
    public function getDisable() {
        return $this->disable;
    }


    /**
     * Sets disable 
     * 
     * @param boolean $disable 
     * @return void 
     */
    public function setDisable($disable) {    
        $this->disable = $disable;
    }


    /** 
     * Returns the boolean state of disable 
     * 
     * @return boolean 
     */
    public function isDisabled() {    
        return $this->getdisable();
    }

    /**
     * Gets the value of confirmpassword.
     *
     * @return string
     */
    public function getConfirmpassword()
    {
        return $this->confirmpassword;
    }

    /**
     * Sets the value of confirmpassword.
     *
     * @param string $confirmpassword the confirmpassword
     *
     * @return self
     */
    public function setConfirmpassword($confirmpassword)
    {
        $this->confirmpassword = $confirmpassword;

        return $this;
    }
}
?>
