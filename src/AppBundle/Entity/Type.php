<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Gedmo\Mapping\Annotation as Gedmo;
//use Symfony\Component\Validator\Constraints as Assert;
//use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity
 */
class Type //implements UserInterface
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(length=8)
     */
    protected $grouper;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $name;
    
        /**
     * @ORM\Column(type="string", length=256)
     */
    protected $description;
    
        /**
     * @ORM\Column(type="string", length=4)
     */
    protected $code;
    
    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="type")
     */
    private $items;

    public function __construct()
    {
        $this->items = new ArrayCollection();
    }  
    


    public function getId()
    {
        return $this->id;
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setCode($code)
    {
        $this->code = $code;
    }

    public function getCode()
    {
        return $this->code;
    }
    public function getDescription() {
        return $this->description;
    }

    public function getItems() {
        return $this->items;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function setItems($items) {
        $this->items = $items;
        return $this;
    }

    public function getGrouper() {
        return $this->grouper;
    }

    public function setGrouper($grouper) {
        $this->grouper = $grouper;
        return $this;
    }

}
