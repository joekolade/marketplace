<?php

namespace JS\Marketplace\Controller;

use JS\Marketplace\Domain\Model\Filter;

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
 * ProductController
 */
class ProductController extends \JS\Marketplace\Controller\AbstractController
{

    /**
     * cacheUtility
     *
     * @var \TYPO3\CMS\Core\Cache\CacheManager
     */
    protected $cacheInstance;

    /**
     * @var \TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer
     */
    protected $cObj;

    public function initializeAction()
    {
        $this->cacheInstance = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Cache\\CacheManager')->getCache("marketplace");
        $this->cObj = $this->configurationManager->getContentObject();
    }


    /**
     * action list
     *
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @return void
     */
    public function listAction(\JS\Marketplace\Domain\Model\Filter $filter = null)
    {
        $filterActive = true;

        if (!$filter) {
            $filter = new \JS\Marketplace\Domain\Model\Filter();
            $filterActive = false;
        }

        $cookie_name = 'sendea_marketplace_listSortby';
        $cacheId = $GLOBALS['TSFE']->id . "-" .
            $this->cObj->data['uid'] . "-" .
            $GLOBALS['TSFE']->sys_language_uid . "-" .
            $this->actionMethodName;

        if ($filter->getSearchphrase()) {
            $cacheId .= $filter->getSearchphrase();
        }
        if ($filter->getSortby()) {
            setcookie($cookie_name, $filter->getSortby(), null, '/');
            $cacheId .= "-" . $filter->getSortby();
        } else {
            if ($filter->getSortby() == 0) {
                setcookie($cookie_name, 0, null, '/');
            } else {
                if ($_COOKIE[$cookie_name]) {
                    $filter->setSortby($_COOKIE[$cookie_name]);
                }
            }
        }

        if (count($filter->getProducer())) {
            $cacheId .= '-prod';
            foreach ($filter->getProducer() as $prod) {
                $cacheId .= $prod->getUid();
            }
        }

        if (count($filter->getProductgroup())) {
            $cacheId .= '-group' . $filter->getProductgroup()->getUid();
        }
        if (count($filter->getProductsubgroup())) {
            $cacheId .= '-subgroups';
            foreach ($filter->getProductsubgroup() as $sg) {
                $cacheId .= $sg->getUid();
            }
        }
        // Cache identifier
        $cacheIdentifier = md5($cacheId);

        $cacheData = array();
        // Is there a cache?
        if ($this->cacheInstance->has($cacheIdentifier)) {
            // Cache vorhanden
            $cacheData = $this->cacheInstance->get($cacheIdentifier);
        } else {
            // Get the products and put them to the filter data
            $products = $this->productRepository->findByFilter($filter, false);

            // Sort Products if overallrating
            // second filtering: most rated
            if ($filter->getSortby() == 2) {
                $products = $products->toArray();
                usort($products, array($this, 'compareRatingsAfterOverall'));
            }
            // Sort Products if most rated
            if ($filter->getSortby() == 3) {
                $products = $products->toArray();
                usort($products, array($this, 'compareRatings'));
            }
            // Sort by price (asc)
            if ($filter->getSortby() == 6) {
                $products = $products->toArray();
                usort($products, array($this, 'comparePrice'));
            }
            // Sort by price (desc)
            if ($filter->getSortby() == 7) {
                $products = $products->toArray();
                usort($products, array($this, 'comparePriceDesc'));
            }

            $cacheData['products'] = $products;

            // if filtered by productgroup
            if (count($filter->getProductgroup())) {
                $cacheData['productgroups'] = array($filter->getProductgroup());
                $cacheData['productsubgroups'] = $this->productsubgroupRepository->findByProductgroup($filter->getProductgroup());
            } else {
                $cacheData['productgroups'] = $this->productgroupRepository->findAll();
                $cacheData['productsubgroups'] = null;
            }

            // Write Data to cache
            $this->cacheInstance->set($cacheIdentifier, $cacheData, array('marketplaceTag'));
        }

        $this->view->assignMultiple([
            // The filtered articles
            'products' => $cacheData['products'],

            // all Productgroups & Productsubgroups (for the filter)
            'productgroups' => $cacheData['productgroups'],
            'productsubgroups' => $cacheData['productsubgroups'],
            'countries' => $this->countryRepository->findAll(),
            'producers' => $this->producerRepository->findAll(),

            // Filter
            'filter' => $filter,
            'filterActive' => $filterActive,

            // View
            'view' => 'list',
        ]);
    }


    public function initializeRatinglistAction()
    {
        // $propertyMappingConfiguration = $this->arguments['filter']->getPropertyMappingConfiguration();
        //  $propertyMappingConfiguration->allowProperties('productgroup');
        // set sctual overallRating for all products
        $prods = $this->productRepository->findAll();
        foreach ($prods as $p) {
            $p->setAverageRating($p->getOverallrating());
            $this->productRepository->update($p);
        }
    }

    /**
     * action ratinglist
     *
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @ignorevalidation $filter
     * @return void
     */
    public function ratinglistAction(\JS\Marketplace\Domain\Model\Filter $filter = null)
    {
        $filterActive = true;

        if (!$filter) {
            $filter = new \JS\Marketplace\Domain\Model\Filter();
            $filterActive = false;
        }

        $cookie_name = 'sendea_marketplace_listSortby';

        if ($filter->getSortby()) {
            setcookie($cookie_name, $filter->getSortby(), null, '/');
        } else {
            if ($filter->getSortby() == 0) {
                setcookie($cookie_name, 0, null, '/');
            } else {
                if ($_COOKIE[$cookie_name]) {
                    $filter->setSortby($_COOKIE[$cookie_name]);
                }
            }
        }

        // Get the products
        $products = $this->productRepository->findByFilter($filter, false);

        // if filtered by productgroup
        if (count($filter->getProductgroup())) {
            $productgroups = array($filter->getProductgroup());
            $productsubgroups = $this->productsubgroupRepository->findByProductgroup($filter->getProductgroup());
        } else {
            $productsubgroups = null;
            $productgroups = $this->productgroupRepository->findAll();
        }

        // Sort Products if overallrating
        // second filtering: most rated
        if ($filter->getSortby() == 2) {
            $products = $products->toArray();
            usort($products, array($this, 'compareRatingsAfterOverall'));
        }
        // Sort Products if most rated
        if ($filter->getSortby() == 3) {
            $products = $products->toArray();
            usort($products, array($this, 'compareRatings'));
        }

        $this->view->assignMultiple([
            // The filtered articles
            'products' => $products,

            // all Productgroups & Productsubgroups (for the filter)
            'productgroups' => $productgroups,
            'productsubgroups' => $productsubgroups,
            'countries' => $this->countryRepository->findAll(),
            'producers' => $this->producerRepository->findAll(),

            // Filter
            'filter' => $filter,
            'filterActive' => $filterActive,

            // View
            'view' => 'list',
        ]);
    }

    /**
     * action showProductRatings
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @ignorevalidation $product
     * @return void
     */
    public function showProductRatingsAction(\JS\Marketplace\Domain\Model\Product $product = null)
    {
        if (!$product) {
            $this->redirect(
                'ratinglist'
            );
        }
        $this->view->assign('product', $product);
    }

    /**
     * action show
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @ignorevalidation $product
     * @return void
     */
    public function showAction(\JS\Marketplace\Domain\Model\Product $product = null)
    {
        if (!$product) {
            $this->redirect(
                'list'
            );
        }
        $articles = $this->articleRepository->findByProduct($product);

        $this->view->assign('product', $product);
        $this->view->assign('articles', $this->sortByPrice($articles->toArray()));
        $this->view->assign('view', 'detail');
    }

    /**
     * Rate a product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     *
     * @return void
     */
    public function rateProductAction($product, $rating = null)
    {
        if (!$rating) {
            $rating = new \JS\Marketplace\Domain\Model\Rating();
            $rating->setProduct($product);
        }
        // Show rating form
        // no matter if logged in or not

        $this->view->assign('rating', $rating);
        $this->view->assign('product', $product);
    }

    // public function initializeSendRatingAction()
    // {
    //   \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($this->request->getArguments());
    // }

    /**
     * Rate a product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     *
     * @return void
     */
    public function sendRatingAction($product, $rating = null)
    {


        $rating->setProduct($product);

        // Sanitize
        $rating->setCountry($this->sanitize($rating->getCountry()));
        $rating->setPosition($this->sanitize($rating->getPosition()));
        $rating->setRatingtext($this->sanitize($rating->getRatingtext()));

        $this->view->assign('product', $product);

        //
        // Logged in?
        // Persistance of rating
        //
        $user = $this->forwardIfNotLoggedIn($rating);

        if ($user) {
            // Allowed to rate?
            $d = $this->daysSinceLastRating($user, $product);

            if (
                // There is a rating other than the actual rating
                $d &&
                // And it lies not long enogh in the past
                $d <= $this->settings['daysbetweenRatings']
            ) {
                // No Rating allowed!

                $this->ratingRepository->remove($rating);
                $this->sendMessage(
                    'You are not allowed to rate this product!',
                    $user->getName() . ', you may rate this product again '
                    . (($this->settings['daysbetweenRatings'] - $d) ? 'in ' . ($this->settings['daysbetweenRatings'] - $d) . ' days!' : ' tomorrow'),
                    'warning'
                );

                //
                // Date an User
                //
            } else {

                $rating->setRatinguser($user);
                // Hidden is TRUE by default
                $rating->setHidden(false);
                // Send update to DB
                $this->ratingRepository->update($rating);
                // Set overall/average rating
                $product->setAverageRating($product->getOverallrating());
                $this->productRepository->update($product);

                $this->sendMessage('Thank you ' . $user->getName(), 'Your rating has been saved.', 'ok');
                // Send to view
                $this->view->assign('rating', $rating);
            }
        }

    }

    /**
     * Show form to propose a product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @return void
     */
    public function showProposeProductFormAction($product = null)
    {
        if (!$product) {
            $product = new \JS\Marketplace\Domain\Model\Product();
        }

        $this->view->assignMultiple(array(
            'product' => $product,
            'productgroups' => $this->productgroupRepository->findAll(),
            // 'productsubgroups' => $this->productsubgroupRepository->findAll(),
            'producers' => $this->producerRepository->findAll(),
        ));

    }


    /**
     * Propose a product
     *
     * @param \JS\Marketplace\Domain\Model\Product $product
     *
     * @return void
     */
    public function proposeProductAction($product = null)
    {
        // Handle product
        // from registration confirmation
        if (!$product) {
            if ($this->request->hasArgument('product')) {
                $product = $this->productRepository->findHiddenByUid($this->request->getArgument('product'));
            }
        }

        //
        // Use product teaser as "hash"-field
        //
        $hash = sha1($product->getTitle() . date('U'));
        $product->setTeaser($hash);


        // Sanitize
        $product->setTitle($this->sanitize($product->getTitle()));
        $product->setDescription($this->sanitize($product->getDescription()));

        //
        // Login/Register user
        //
        $user = $this->forwardIfNotLoggedIn(null, $product);
        $product->setProposinguser($user);
        $this->productRepository->update($product);

        //
        // send email to admin to approve the product
        //
        $emailSettings = $this->settings['adminster']['email'];

        $recipients = array($emailSettings['receiver'] => $emailSettings['receiverName']);
        $sender = array($emailSettings['sender'] => $emailSettings['senderName']);
        $subject = $emailSettings['subjectReceiver'];
        $templateName = 'AdminProduct';
        $arguments = array(
            'settings' => $this->settings,
            'user' => $user,
            'hash' => $hash,
            'product' => $product,
        );

        // send email to admin team
        if (!$this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments)) {
            $error = true;
        }

        // Feed the view
        $this->view->assign('product', $product);
    }

    /**
     * adminProductAction
     *
     * @return void
     */
    public function adminProductAction()
    {
        // Error switch
        $error = true;

        // Prepare flashmessage
        $title = 'An error occured!';
        $body = 'This page is used by admins only. Sorry.';
        $severity = 'error';

        $hash = $this->request->getArgument('hash');
        $product = $this->productRepository->findHiddenByUid($this->request->getArgument('product'));

        // Check if hash is ok
        if ($product && $product->getTeaser() === $hash) {
            // Email basics
            $emailSettings = $this->settings['email'];
            $recipients = array($product->getProposinguser()->getEmail() => $product->getProposinguser()->getName());
            $sender = array($emailSettings['sender'] => $emailSettings['senderName']);
            $arguments = array(
                'settings' => $this->settings,
                'user' => $user,
                'hash' => $hash,
                'product' => $product,
            );

            // So far no errors
            $error = false;
            switch ($this->request->getArgument('do')) {
                case 'accept':
                    // OPTIONAL: edit product

                    // Product unhide
                    $product->setHidden(false);
                    // Remove "hash"
                    $product->setTeaser('');
                    $this->productRepository->update($product);

                    // email settings
                    $templateName = 'UserProductAccepted';
                    $subject = $emailSettings['userProductAcceptedSubject'];

                    // Flashmessage
                    $title = 'Product (' . $product->getTitle() . ') accepted!';
                    $body = 'The product was accepted and activated.<br />The proposing user was informed about this action.';
                    $severity = 'ok';

                    break;
                case 'decline':
                    // OPTIONAL: reason for decline

                    // Remove "hash"
                    $product->setTeaser('');
                    $this->productRepository->update($product);
                    // email settings
                    $templateName = 'UserProductDeclined';
                    $subject = $emailSettings['userProductDeclinedSubject'];

                    // Flashmessage
                    $title = 'Product (' . $product->getTitle() . ') declined!';
                    $body = 'The product was declined and deleted.<br />The proposing user was informed about this action.';
                    $severity = 'warning';

                    // Product delete
                    $this->productRepository->remove($product);

                    break;
                default:
                    // OPTIONAL: chose action?!?
                    $error = true;
            }

            //
            // send email to user
            //
            if (!$error && !$this->sendTemplateEmail($recipients, $sender, $subject, $templateName, $arguments)) {
                $error = true;
            }
        }

        $this->sendMessage($title, $body, $severity);

        $this->view->assignMultiple(array(
            'error' => $error,
            'product' => $product,
        ));
    }


    /**
     * Sort Query result by comparable price
     *
     * @var array $query
     *
     * @return array
     */
    private function sortByPrice($query)
    {
        usort($query, function ($a, $b) {
            if ($a->getComparablePrice() == $b->getComparablePrice()) {
                return 0;
            }
            return ($a->getComparablePrice() < $b->getComparablePrice()) ? -1 : 1;
        });


        return $query;
    }


    /**
     * Show login and register form and passthrough (new) rating
     *
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @param boolean $message
     * @ignorevalidation $rating
     * @ignorevalidation $product
     * @return void
     */
    public function loginFormAction($rating = null, $product = null, $message = false)
    {
        if (!$message) {
            $this->sendMessage(
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('loginFirstTitle', 'marketplace'),
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('loginToRateText', 'marketplace'),
                'warning'
            );
        }

        // \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($rating);
        $this->view->assignMultiple(array(
            'rating' => $rating,
            'product' => $product,
        ));
    }


    /**
     * Do the login
     *
     * @return void
     */
    public function loginAction()
    {
        $rating = null;
        $product = null;

        if (!empty($this->request->getArgument('rating'))) {
            $rating = $this->ratingRepository->findHiddenByUid(intval($this->request->getArgument('rating')['__identity']));
        }
        if (!empty($this->request->getArgument('product'))) {
            $product = $this->productRepository->findHiddenByUid(intval($this->request->getArgument('product')['__identity']));
        }

        // not logged in, error while filling the form
        // if(!($this->request->hasArgument('uname') || $this->request->hasArgument('password') )){
        //   $this->forward(
        //       'loginForm',
        //       NULL,
        //       NULL,
        //       array('rating' => $rating, 'product' => $product)
        //   );
        // }


        if ($this->loginUser($this->request->getArgument('uname'), $this->request->getArgument('password'))) {
            // login successfull
            $user = $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);

            if ($product) {
                // product is not switched on, since it has to be reviewd
                $product->setProposinguser($user);
                $this->productRepository->update($product);
                $this->forward(
                    'proposeProduct',
                    null,
                    null,
                    array(
                        'product' => $product,
                        'rating' => $rating
                    )
                );
            } elseif ($rating) {
                // switches rating not on
                // $rating->setHidden(0);
                $rating->setRatinguser($user);
                $this->ratingRepository->update($rating);
                $product = $rating->getProduct();

                $this->forward(
                    'sendRating',
                    null,
                    null,
                    array(
                        'rating' => $rating,
                        'product' => $product
                    )
                );
            } else {
                die('Error while logging in!');
            }
        } else {
            $this->sendMessage(
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('loginErrorTitle', 'marketplace'),
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('loginErrorText', 'marketplace'),
                'error'
            );
            $this->forward(
                'loginForm',
                null,
                null,
                array('rating' => $rating, 'product' => $product, 'message' => true)
            );
        }
    }


    /**
     * Forward to login/register action or return user object
     *
     * @param \JS\Marketplace\Domain\Model\Rating $rating
     * @param \JS\Marketplace\Domain\Model\Product $product
     * @ignorevalidation $rating
     * @ignorevalidation $product
     * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
     */
    private function forwardIfNotLoggedIn($rating = null, $product = null)
    {
        // Persistance of objects
        if ($rating) {
            $this->ratingRepository->add($rating);
        }
        if ($product) {
            $this->productRepository->add($product);
        }
        $persistenceManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->persistAll();

        if ($GLOBALS['TSFE']->fe_user->user) {
            // return $userObject = $feUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
            return $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
        } else {
            // redirect to login/register action
            $this->forward(
                'loginForm',
                null,
                null,
                array('rating' => $rating, 'product' => $product)
            );
        }
    }

    /**
     * [daysSinceLastRating description]
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $user [description]
     * @param \JS\Marketplace\Domain\Model\Product $product
     *
     * @return mixed
     */
    protected function daysSinceLastRating($user, $product)
    {
        // Get last rating
        $lastRating = $this->ratingRepository->findLastByProductAndUser($product, $user);

        if ($lastRating) {
            $secs = time() - $lastRating->getCrdate();
            if ($secs < 5) {
                return false;
            }
            $days = ceil($secs / (86400));
            return $days;
        }

        return false;
    }

    protected function compareRatings($a, $b)
    {
        $ar = count($a->getRatings());
        $br = count($b->getRatings());
        if ($ar == $br) {
            return 0;
        }
        return ($ar > $br) ? -1 : 1;
    }

    protected function compareRatingsAfterOverall($a, $b)
    {
        $ar = $a->getAveragerating();
        $br = $b->getAveragerating();

        if ($ar == $br) {
            return $this->compareRatings($a, $b);
        }
        return ($ar >= $br) ? -1 : 1;
    }

    protected function comparePrice($a, $b, $asc = true)
    {
        $aArt = $a->getArticles();
        $bArt = $b->getArticles();
        $aLowestPrice = (float)1000000000;
        $bLowestPrice = (float)1000000000;

        foreach ($aArt as $article) {
            $aLowestPrice = min($article->getComparablePrice(), $aLowestPrice);
        }
        foreach ($bArt as $article) {
            $bLowestPrice = min($article->getComparablePrice(), $bLowestPrice);
        }

        if (count($aArt) == 0) {
            return 1;
        }
        if (count($bArt) == 0) {
            return -1;
        }

        // Switch/Swap ordering
        if (!$asc) {
            $tmp = $aLowestPrice;
            $aLowestPrice = $bLowestPrice;
            $bLowestPrice = $tmp;
        }

        return ($aLowestPrice >= $bLowestPrice) ? 1 : -1;
    }

    protected function comparePriceDesc($a, $b)
    {
        return $this->comparePrice($a, $b, false);
    }


    /**
     * catList Action
     *
     * @param \JS\Marketplace\Domain\Model\Filter $filter
     * @return void
     */
    public function catListAction($filter = NULL)
    {
        if(!$filter){
            $filter = new Filter();
        }

        \TYPO3\CMS\Extbase\Utility\DebuggerUtility::var_dump($filter, 'Filter after init');

        $category = $this->categoryRepository->findByUid($this->settings['category']);
        $products = $this->productRepository->findByOptions($filter, $category);

        // Get options by filtered products
        $options = [];
        foreach ($products as $product) {
            foreach ($product->getOptions() as $option) {
                if(!in_array($option, $options)) {
                    $options[] = $option;
                }
            }
        }

        // TODO: get producers by products
        $producers = $this->producerRepository->findAll();

        $this->view->assignMultiple(array(
            'filter' => $filter,
            'products' => $products,
            'producers' => $producers,
            'options' => $options,
            'category' => $category
        ));

    }

}
