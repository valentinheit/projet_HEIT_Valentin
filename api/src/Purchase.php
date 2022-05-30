<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Purchase
 *
 * @ORM\Table(name="purchase")
 * @ORM\Entity
 */
class Purchase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_purchase", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="purchase_id_purchase_seq", allocationSize=1, initialValue=1)
     */
    private $idOrder;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ProductPurchase", mappedBy="order")
     */
    private $productPurchases;

    /**
     * @var \Client
     *
     * @ORM\ManyToOne(targetEntity="Client", inversedBy="orders")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="buyer_id", referencedColumnName="id_user")
     * })
     */
    private $buyer;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->productPurchases = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get idOrder.
     *
     * @return int
     */
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Purchase
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Add productPurchase.
     *
     * @param \ProductPurchase $productPurchase
     *
     * @return Purchase
     */
    public function addProductPurchase(\ProductPurchase $productPurchase)
    {
        $this->productPurchases[] = $productPurchase;

        return $this;
    }

    /**
     * Remove productPurchase.
     *
     * @param \ProductPurchase $productPurchase
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeProductPurchase(\ProductPurchase $productPurchase)
    {
        return $this->productPurchases->removeElement($productPurchase);
    }

    /**
     * Get productPurchases.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProductPurchases()
    {
        return $this->productPurchases;
    }

    /**
     * Set buyer.
     *
     * @param \Client|null $buyer
     *
     * @return Purchase
     */
    public function setBuyer(\Client $buyer = null)
    {
        $this->buyer = $buyer;

        return $this;
    }

    /**
     * Get buyer.
     *
     * @return \Client|null
     */
    public function getBuyer()
    {
        return $this->buyer;
    }
}
