<?php

namespace User\Controller;

use Zend\Authentication\Result;
use User\Entity\User;
use Zend\View\Model\JsonModel;
use Zend\Mvc\Controller\AbstractRestfulController;
use Firebase\JWT\JWT;

/**
 * This controller is responsible for letting the user to log in and log out.
 */
class AuthController extends AbstractRestfulController
{
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager 
     */
    private $entityManager;
    
    /**
     * Auth manager.
     * @var User\Service\AuthManager 
     */
    private $authManager;
    
    /**
     * Auth service.
     * @var \Zend\Authentication\AuthenticationService
     */
    private $authService;
    
    /**
     * User manager.
     * @var User\Service\UserManager
     */
    private $userManager;
    
    /**
     * Constructor.
     */    
    private $container;
    
    public function __construct($entityManager, $authManager, $authService, $userManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->authManager = $authManager;
        $this->authService = $authService;
        $this->userManager = $userManager;
        $this->container = $container;
    }
   
    public function options(){
        
    }
    
    public function create($data)
    {
        $this->userManager->createAdminUserIfNotExists();
       
        $config = $this->container->get('config');
        
        // Check if user has submitted the form
        if (count($data) > 0) {
            //print_r($data);
            
            $data['remember_me'] = 0;
            
            // Perform login attempt.
            $result = $this->authManager->login($data['email'], $data['password'], $data['remember_me']);
            
            // Check result.
            if ($result->getCode() == Result::SUCCESS ) {
                $tokenId    = base64_encode(random_bytes(32));
                $issuedAt   = time();
                $notBefore  = $issuedAt;  //Adding 10 seconds
                $expire     = $notBefore + 60; // Adding 60 seconds
                //$serverName = $config['serverName'];
                $serverName = "athena";
                
                $user = $this->entityManager->getRepository(User::class)->findOneByEmail($data['email']);
                /*
                 * Create the token as an array
                 */
                $data = [
                    'iat'  => $issuedAt,         // Issued at: time when the token was generated
                    'jti'  => $tokenId,          // Json Token Id: an unique identifier for the token
                    'iss'  => $serverName,       // Issuer
                    'nbf'  => $notBefore,        // Not before
                    'exp'  => $expire,           // Expire
                    'data' => [                  // Data related to the signer user
                        'userId'   => $user->getId(), // userid from the users table
                        'userName' => $user->getEmail(), // User name
                    ]
                ];
                
                $secretKey = base64_decode($config['jwt']['key']);
                $algorithm = $config['jwt']['algorithm'];
                
                $jwt = JWT::encode(
                    $data,      //Data to be encoded in the JWT
                    $secretKey, // The signing key
                    $algorithm  // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
                    ); 
                $user = '';
                
                return new JsonModel(array("data" => array(
                    'status'   => ($result->getCode() == Result::SUCCESS ? "success": "failure"),
                    'token'    => 'xxx',
                    'jwt'      => $jwt,
                    'user'     => $data['data']
                )));
            } else {
                header('HTTP/1.0 401 Unauthorized');
                return new JsonModel(array("data" => array(
                    'status'   => ($result->getCode() == Result::SUCCESS ? "success": "failure"),
                    'token'    => 'xxx',
                )));
                
            }
        } else {
            die(header('HTTP/1.0 405 Method Not Allowed'));
        }
    }
    
    public function userAction()
    {
        if ($this->getRequest()->isGet()) {
            $authHeader = $this->getRequest()->getHeader('authorization');
            
            if ($authHeader) {
                list($jwt) = sscanf( $authHeader->toString(), 'Authorization: Bearer %s');
                
                if ($jwt) {
                    $config = $this->container->get('config');
                    
                    $secretKey = base64_decode($config['jwt']['key']);

                    try {
                        $token = JWT::decode(
                            $jwt, 
                            $secretKey, 
                            [($config['jwt']['algorithm'])]
                            );
                    
                    } catch (\Exception $e) {
                        $this->authManager->logout();
                        die($e->getMessage());
                        //die(header('HTTP/1.0 401 Unauthorized'));
                    }
                
                    return new JsonModel(array("data" => array(
                        'toke' => $token,
                        'status' => 'success'
                    )));
                    //$asset = base64_encode(file_get_contents('http://lorempixel.com/200/300/cats/'));
                    
                }else {
                    die(header('HTTP/1.0 401 Unauthorized'));
                }
                
            } else {
                die(header('HTTP/1.0 400 Bad Request'));
            }
        } else {
            die(header('HTTP/1.0 405 Method Not Allowed'));
        }
        
        /*return new JsonModel(array("data" => array(
            'status' => 'success'
        )));*/
    }
    
    public function logoutAction()
    {
        try {
        $this->authManager->logout();
        } catch (\Exception $e){
            return new JsonModel([
                'data' => [
                    "reponse" => $e->getMessage()
                ]
            ]);
        }
        
        return new JsonModel([
            'data' => [
                "reponse" => 'unsuccsses'
            ]
        ]);
    }
 
}
