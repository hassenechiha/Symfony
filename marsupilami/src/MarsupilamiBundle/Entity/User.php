<?php
/**
 * Created by PhpStorm.
 * User: Hasse
 * Date: 11/09/2018
 * Time: 00:02
 */

namespace MarsupilamiBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ORM\Entity(repositoryClass="MarsupilamiBundle\Repository\MarsupilamiRepository")
 */

class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $prenom;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $famille;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $race;
    /**
     * @ORM\Column(type="string",length=255)
     */
    private $nourriture;
    /**
     * @ORM\Column(type="integer")
     */
    private $age;
    /**
     * @ORM\ManyToMany(targetEntity="User")
     * @ORM\JoinTable(name="friends",
     *     joinColumns={@ORM\JoinColumn(name="user_a_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="user_b_id", referencedColumnName="id")}
     * )
     * @var  \Doctrine\Common\Collections\ArrayCollection
     */
    private $friends;


    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }



    /**
     * @return mixed
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * @param mixed $famille
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;
    }

    /**
     * @return mixed
     */
    public function getNourriture()
    {
        return $this->nourriture;
    }

    /**
     * @param mixed $nourriture
     */
    public function setNourriture($nourriture)
    {
        $this->nourriture = $nourriture;
    }

    /**
     * @return mixed
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * @param mixed $race
     */
    public function setRace($race)
    {
        $this->race = $race;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * User constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->friends = new \Doctrine\Common\Collections\ArrayCollection();
    }
    /**
     * @return array
     */
    public function getFriends()
    {
        return $this->friends->toArray();
    }

    /**
     * @param  User $user
     * @return void
     */
    public function addFriend(User $user)
    {
        if (!$this->friends->contains($user)) {
            $this->friends->add($user);
            $user->addFriend($this);
        }
    }

    /**
     * @param  User $user
     * @return void
     */
    public function removeFriend(User $user)
    {
        if ($this->friends->contains($user)) {
            $this->friends->removeElement($user);
            $user->removeFriend($this);
        }
    }


}