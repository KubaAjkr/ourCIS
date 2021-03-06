<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class User implements UserInterface {

    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255 )
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=40, unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\OneToMany(targetEntity="Item", mappedBy="user")
     */
    private $items;

    /**
     * @ORM\Column(type="string", length=64, unique=false)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=64, unique=false)
     */
    protected $surename;

    /**
     * @ORM\Column(name="created", type="datetime", options={"comment" = "Timestamp when the row was created"})
     * @Gedmo\Timestampable(on="create")
     */
    protected $created;

    public function __construct() {
        $this->items = new ArrayCollection();
    }

    public function eraseCredentials() {
        return null;
    }

    public function getRole() {
        return $this->role;
    }

    public function setRole($role = null) {
        $this->role = $role;
    }

    public function getRoles() {
        return [$this->getRole()];
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getCreated() {
        $serializer = new Serializer(array(new DateTimeNormalizer()));
        $dateAsString = $serializer->normalize(
                $this->created, null, [DateTimeNormalizer::FORMAT_KEY => 'd.m.Y H:i:s']
        );
        return $dateAsString;
    }

    public function setCreated($created) {
        $this->created = $created;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword) {
        $this->plainPassword = $plainPassword;
    }

    public function getSalt() {
        return null;
    }

    public function getFirstname() {
        return $this->firstname;
    }

    public function setFirstname($firstname) {
        $this->username = $firstname;
    }

    public function getSurename() {
        return $this->surename;
    }

    public function setSurename($surename) {
        $this->username = $surename;
    }

    /**

     * Triggered on insert



     * @ORM\PrePersist

     */
    public function onPrePersist() {

        $this->created = new \DateTime("now");
    }

}
