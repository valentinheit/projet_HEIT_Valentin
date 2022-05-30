<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=32, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="brand", type="string", length=32, nullable=true)
     */
    private $brand;

    /**
     * @var int|null
     *
     * @ORM\Column(name="cores", type="integer", nullable=true)
     */
    private $cores;

    /**
     * @var int|null
     *
     * @ORM\Column(name="threads", type="integer", nullable=true)
     */
    private $threads;

    /**
     * @var int|null
     *
     * @ORM\Column(name="price", type="integer", nullable=true)
     */
    private $price;


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
     * Set name.
     *
     * @param string|null $name
     *
     * @return Product
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set brand.
     *
     * @param string|null $brand
     *
     * @return Product
     */
    public function setBrand($brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand.
     *
     * @return string|null
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set cores.
     *
     * @param int|null $cores
     *
     * @return Product
     */
    public function setCores($cores = null)
    {
        $this->cores = $cores;

        return $this;
    }

    /**
     * Get cores.
     *
     * @return int|null
     */
    public function getCores()
    {
        return $this->cores;
    }

    /**
     * Set threads.
     *
     * @param int|null $threads
     *
     * @return Product
     */
    public function setThreads($threads = null)
    {
        $this->threads = $threads;

        return $this;
    }

    /**
     * Get threads.
     *
     * @return int|null
     */
    public function getThreads()
    {
        return $this->threads;
    }

    /**
     * Set price.
     *
     * @param int|null $price
     *
     * @return Product
     */
    public function setPrice($price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return int|null
     */
    public function getPrice()
    {
        return $this->price;
    }
}
