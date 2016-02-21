<?php

namespace AppBundle\Security\Core\User;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserManagerInterface;
use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseFOSUBProvider;
use Monolog\Logger;
use Symfony\Component\Security\Core\User\UserInterface;

class MyFOSUBUserProvider extends BaseFOSUBProvider
{

    /** @var Logger $logger */
    private $logger;

    /** @var EntityManager $em */
    private $em;

    /**
     * MyFOSUBUserProvider constructor.
     * @param UserManagerInterface $userManager
     * @param array $properties
     * @param Logger $logger
     * @param EntityManager $entityManager
     */
    public function __construct(UserManagerInterface $userManager, array $properties, Logger $logger, EntityManager $entityManager)
    {
        parent::__construct($userManager,$properties);
        $this->logger = $logger;
        $this->em = $entityManager;
    }

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    {
        //we "disconnect" previously connected users
        $existingUser = $this->userManager->findUserByEmail($response->getEmail());
        if (null !== $existingUser) {
            //TODO: update this part

            $this->userManager->updateUser($existingUser);
        }
        //we connect current user, set current user id and token
        // ...
        $this->userManager->updateUser($user);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        $userEmail = $response->getEmail();
        $user = $this->userManager->findUserByEmail($userEmail);

        // if null just create new user and set it properties
        if (null === $user) {
            $userData = $response->getResponse();
            $user = new User();
            $user->setUsername($userData['formattedName']);
            $user->setPlainPassword(rand(1000000,10000000)); //TODO:find a better option
            //TODO: add location, company name, ..


            $user->setEmail($response->getEmail());
            $user->setEnabled(true);

            $this->userManager->updateUser($user);
            $this->em->flush();

            return $user;
        }
        // else update access token of existing user
        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';
        $user->$setter($response->getAccessToken());//update access token

        return $user;
    }
}
