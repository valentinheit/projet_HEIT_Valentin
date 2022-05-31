<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client", uniqueConstraints={@ORM\UniqueConstraint(name="client_email_key", columns={"email"})})
 * @ORM\Entity
 */
class Client
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="client_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom", type="string", length=48, nullable=true)
     */
    private $nom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom", type="string", length=48, nullable=true)
     */
    private $prenom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=256, nullable=true)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=200, nullable=true)
     */
    private $ville;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codepostal", type="string", length=100, nullable=true)
     */
    private $codepostal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string|null $nom
     *
     * @return Client
     */
    public function setNom($nom = null)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string|null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom.
     *
     * @param string|null $prenom
     *
     * @return Client
     */
    public function setPrenom($prenom = null)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom.
     *
     * @return string|null
     */
    public function getPrenom()
    {
        return $this->prenom;
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
     * Set password.
     *
     * @param string|null $password
     *
     * @return Client
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set ville.
     *
     * @param string|null $ville
     *
     * @return Client
     */
    public function setVille($ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string|null
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set codepostal.
     *
     * @param string|null $codepostal
     *
     * @return Client
     */
    public function setCodepostal($codepostal = null)
    {
        $this->codepostal = $codepostal;

        return $this;
    }

    /**
     * Get codepostal.
     *
     * @return string|null
     */
    public function getCodepostal()
    {
        return $this->codepostal;
    }

    /**
     * Set telephone.
     *
     * @param int|null $telephone
     *
     * @return Client
     */
    public function setTelephone($telephone = null)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return int|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
