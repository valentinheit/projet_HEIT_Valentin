<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", uniqueConstraints={@ORM\UniqueConstraint(name="login_un", columns={"login"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_user", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="client_id_user_seq", allocationSize=1, initialValue=1)
     */
    private $idUser;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lastname", type="string", length=256, nullable=true)
     */
    private $lastname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstname", type="string", length=256, nullable=true)
     */
    private $firstname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="civility", type="string", length=256, nullable=true)
     */
    private $civility;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=256, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zipCode", type="string", length=256, nullable=true)
     */
    private $zipCode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=256, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=256, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="phone", type="string", length=256, nullable=true)
     */
    private $phone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=256, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=256, nullable=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=256, nullable=false)
     */
    private $password;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Purchase", mappedBy="buyer")
     */
    private $orders;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->orders = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idUser.
     *
     * @return int
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set lastname.
     *
     * @param string|null $lastname
     *
     * @return Client
     */
    public function setLastname($lastname = null)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string|null
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname.
     *
     * @param string|null $firstname
     *
     * @return Client
     */
    public function setFirstname($firstname = null)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string|null
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set civility.
     *
     * @param string|null $civility
     *
     * @return Client
     */
    public function setCivility($civility = null)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility.
     *
     * @return string|null
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * Set street.
     *
     * @param string|null $street
     *
     * @return Client
     */
    public function setStreet($street = null)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street.
     *
     * @return string|null
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set zipCode.
     *
     * @param string|null $zipCode
     *
     * @return Client
     */
    public function setZipCode($zipCode = null)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode.
     *
     * @return string|null
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set city.
     *
     * @param string|null $city
     *
     * @return Client
     */
    public function setCity($city = null)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city.
     *
     * @return string|null
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set country.
     *
     * @param string|null $country
     *
     * @return Client
     */
    public function setCountry($country = null)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country.
     *
     * @return string|null
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set phone.
     *
     * @param string|null $phone
     *
     * @return Client
     */
    public function setPhone($phone = null)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string|null
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return Client
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set login.
     *
     * @param string $login
     *
     * @return Client
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * Get login.
     *
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password.
     *
     * @param string $password
     *
     * @return Client
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Add order.
     *
     * @param \Purchase $order
     *
     * @return Client
     */
    public function addOrder(\Purchase $order)
    {
        $this->orders[] = $order;

        return $this;
    }

    /**
     * Remove order.
     *
     * @param \Purchase $order
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeOrder(\Purchase $order)
    {
        return $this->orders->removeElement($order);
    }

    /**
     * Get orders.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrders()
    {
        return $this->orders;
    }
}
