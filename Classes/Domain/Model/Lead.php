<?php
namespace JS\Marketplace\Domain\Model;


/***************************************************************
 *
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
 * Lead
 */
class Lead extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * gender
     *
     * @var string
     * @validate NotEmpty
     */
    protected $gender = '';

    /**
     * name
     *
     * @var string
     * @validate NotEmpty
     */
    protected $name = '';

    /**
     * firstname
     *
     * @var string
     * @validate NotEmpty
     */
    protected $firstname = '';
    
    /**
     * email
     *
     * @var string
     * @validate NotEmpty
     * @ validate EmailAddress
     */
    protected $email = '';
    
    /**
     * message
     *
     * @var string
     */
    protected $message = '';
    
    /**
     * article
     *
     * @var \JS\Marketplace\Domain\Model\Article
     * @lazy
     */
    protected $article = null;
    
    /**
     * Returns the gender
     *
     * @return string $gender
     */
    public function getGender()
    {
        return $this->gender;
    }
    
    /**
     * Sets the gender
     *
     * @param string $gender
     * @return void
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }
    
    /**
     * Returns the name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Sets the name
     *
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    
    /**
     * Returns the firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * Sets the firstname
     *
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    
    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Returns the message
     *
     * @return string $message
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Sets the message
     *
     * @param string $message
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Returns the article
     *
     * @return \JS\Marketplace\Domain\Model\Article $article
     */
    public function getArticle()
    {
        return $this->article;
    }
    
    /**
     * Sets the article
     *
     * @param \JS\Marketplace\Domain\Model\Article $article
     * @return void
     */
    public function setArticle(\JS\Marketplace\Domain\Model\Article $article)
    {
        $this->article = $article;
    }

}
