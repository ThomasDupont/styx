<?php


namespace WebserviceBundle\Models;

use coreBundle\Entity\ApiAuth;

final class AuthentificationManager {

    private $auth = "";
    private $user;

    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine)
    {
        $this->doctrine = $doctrine;
        $this->auth = new ApiAuth();
    }

    public function createApiCrendentials($userId)
    {

    }

    /**
    * @fn check if the user is connected or not
    */
    public function checkApiUserCredential ($apikey, $secret)
    {
        $api = $this->doctrine
            ->getRepository('coreBundle:ApiAuth')
            ->findOneByApikey($apikey);

        $secretFromBase = $api->getSecret();
        $this->user = $api->getUser();

        return $secret == $secretFromBase;
    }

    public function getUserId()
    {
        return empty($this->user) ? "no": $this->user->getId();
    }

    /**
    * @fn remove the secret key only if delete false (after timeout or disconnect)
    * if delete = true, the process delete the api key too (with the delete account process)
    */
    public function removeApiUserCredential($apikey, $delete = false)
    {
        return true;
    }
}
