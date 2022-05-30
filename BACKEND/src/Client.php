<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Client
 *
 * @ORM\Table(name="client")
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
     * @ORM\Column(name="civilite", type="string", length=5, nullable=true)
     */
    private $civilite;

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
     * @ORM\Column(name="adresse", type="string", length=256, nullable=true)
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="codePostal", type="string", length=256, nullable=true)
     */
    private $codePostal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="telephone", type="int", nullable=true)
     */
    private $telephone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pays", type="string", length=256, nullable=true)
     */
    private $pays;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ville", type="string", length=256, nullable=true)
     */
    private $ville;


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
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return Client
     */
    public function setNom($nom = null)
    {
        $this->nom = $nom;

        return $this;
    }


    public function getNom()
    {
        return $this->nom;
    }

    
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


    public function setEmail($email = null)
    {
        $this->email = $email;
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


    public function getCivilite()
    {
        return $this->civilite;
    }

    public function setCivilite($civilite = null)
    {
        $this->civilite = $civilite;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function setVille($ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function setCodePostal($codePostal = null)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getPays()
    {
        return $this->pays;
    }

    public function setPays($pays = null)
    {
        $this->pays = $pays;

        return $this;
    }



    /**
     * Set telephone.
     *
     * @param \int|null $telephone
     *
     * @return Client
     */
    public function setTelephone(\int $telephone = null)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone.
     *
     * @return \int|null
     */
    public function getTelephone()
    {
        return $this->telephone;
    }
}
