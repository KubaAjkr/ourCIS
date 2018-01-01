<?php
namespace AppBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Item;
use AppBundle\Entity\User;

/**
 * @Gedmo\Tree(type="nested")
 * use repository for handy tree functions
 * @ORM\Entity(repositoryClass="Gedmo\Tree\Entity\Repository\NestedTreeRepository")
 */
class Item //implements UserInterface
{
    
     /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\Column(length=8, nullable=true)
     */
    protected $grouper;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $contract_id;

    /**
     * @ORM\Column(length=64)
     */
    private $title;

    /**
     * @Gedmo\TreeLeft
     * @ORM\Column(type="integer")
     */
    private $lft;

    /**
     * @Gedmo\TreeLevel
     * @ORM\Column(type="integer")
     */
    private $lvl;

    /**
     * @Gedmo\TreeRight
     * @ORM\Column(type="integer")
     */
    private $rgt;

    /**
     * @Gedmo\TreeRoot
     * @ORM\ManyToOne(targetEntity="Item")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $root;

    /**
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Item", inversedBy="children")
     * @ORM\JoinColumn(referencedColumnName="id", onDelete="CASCADE")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="parent")
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $type_id;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $user_id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Type", inversedBy="items")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     */
    private $type;
  
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="items")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;
   
    public function getId() {
        return $this->id;
    }

    public function getContract_id() {
        return $this->contract_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getLft() {
        return $this->lft;
    }

    public function getLvl() {
        return $this->lvl;
    }

    public function getRgt() {
        return $this->rgt;
    }

    public function getRoot() {
        return $this->root;
    }

    public function getParent() {
        return $this->parent;
    }

    public function getChildren() {
        return $this->children;
    }

    public function getType_id() {
        return $this->type_id;
    }

    public function getUser_id() {
        return $this->user_id;
    }

    public function getType() {
        return $this->type;
    }

    public function getUser() {
        return $this->user;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setContract_id($contract_id) {
        $this->contract_id = $contract_id;
        return $this;
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function setLft($lft) {
        $this->lft = $lft;
        return $this;
    }

    public function setLvl($lvl) {
        $this->lvl = $lvl;
        return $this;
    }

    public function setRgt($rgt) {
        $this->rgt = $rgt;
        return $this;
    }

    public function setRoot($root) {
        $this->root = $root;
        return $this;
    }

    public function setParent($parent) {
        $this->parent = $parent;
        return $this;
    }

    public function setChildren($children) {
        $this->children = $children;
        return $this;
    }

    public function setType_id($type_id) {
        $this->type_id = $type_id;
        return $this;
    }

    public function setUser_id($user_id) {
        $this->user_id = $user_id;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setUser($user) {
        $this->user = $user;
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
