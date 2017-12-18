<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\User as User;


/**
 * @ORM\Entity
 */
class Item //implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $contract_id;

    /**
     * @ORM\Column(type="string", length=256)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer")
     */
    protected $type_id;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $upper_id;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $variant_id;
    
  
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="items")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
    
    
    public function getUser()
    {
        return $this->user;
    }
        public function setUser($user)
    {
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }
    
    public function setContractId($contract_id)
    {
        $this->contract_id = $contract_id;
    }
    
        public function getContractId()
    {
        return $this->contract_id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setTypeId($type_id)
    {
        $this->type_id = $type_id;
    }
    
        public function getTypeId()
    {
        return $this->type_id;
    }
    
      public function setUpperId($upper_id)
    {
        $this->upper_id = $upper_id;
    }
    
        public function getUpperId()
    {
        return $this->upper_id;
    }  
    
    public function setVariantId($variant_id)
    {
        $this->variant_id = $variant_id;
    }
    
        public function getVariantId()
    {
        return $this->variant_id;
    }  
    
   
 
    
        public function setUserId($user_id)
    {
        $this->user_id = $user_id;
}
    
        public function getUserId()
    {
        return $this->user_id;
    }  
}
