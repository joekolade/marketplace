<?php
namespace JS\Marketplace\Validation\Validator;

class UserExistsValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * userRepository
     *
     * @var \JS\Marketplace\Domain\Repository\UserRepository
     * @inject
     */
    protected $userRepository = NULL;


    public function isValid($value)
    {
        $this->errors = array();
        // Gibt es den Benutzer schon
        if($value != ""){
         
            if($this->userRepository->countHiddenByEmail($value) > 0){
                $error = $this->objectManager->get(
                    'TYPO3\CMS\Extbase\Validation\Error',
                    'Email already exists in database.', 1473714027);
                $this->result->addError($error);
                return FALSE;
            }
        }

        return true;
    }
}
