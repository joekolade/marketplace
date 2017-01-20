<?php
namespace JS\Marketplace\Validation\Validator;

class PasswordValidator extends \TYPO3\CMS\Extbase\Validation\Validator\AbstractValidator {

    /**
     * Object Manager
     *
     * @var \TYPO3\CMS\Extbase\Object\ObjectManager
     * @inject
     */
    protected $objectManager;

    /**
     * Is valid
     *
     * @param mixed $user
     * @return boolean
     */
    public function isValid($user) {
        if ($user->getPassword() !== $user->getConfirmpassword()) {
            $error = $this->objectManager->get(
                    'TYPO3\CMS\Extbase\Validation\Error',
                    'Password and password confirmation do not match.', time());
            $this->result->forProperty('confirmpassword')->addError($error);
            return FALSE;
        }
        return TRUE;
    }

}
