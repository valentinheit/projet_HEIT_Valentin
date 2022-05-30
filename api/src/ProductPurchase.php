<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProductPurchase
 *
 * @ORM\Table(name="productpurchase")
 * @ORM\Entity
 */
class ProductPurchase
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_productpurchase", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="productpurchase_id_productpurchase_seq", allocationSize=1, initialValue=1)
     */
    private $idOrder;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false)
     */
    private $quantity;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float", nullable=false)
     */
    private $price;

    /**
     * @var \Purchase
     *
     * @ORM\ManyToOne(targetEntity="Purchase", inversedBy="productPurchases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="purchase_id", referencedColumnName="id_purchase")
     * })
     */
    private $order;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="purchases")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id_product")
     * })
     */
    private $product;


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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return ProductPurchase
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return ProductPurchase
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set order.
     *
     * @param \Purchase|null $order
     *
     * @return ProductPurchase
     */
    public function setOrder(\Purchase $order = null)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order.
     *
     * @return \Purchase|null
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * Set product.
     *
     * @param \Product|null $product
     *
     * @return ProductPurchase
     */
    public function setProduct(\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product.
     *
     * @return \Product|null
     */
    public function getProduct()
    {
        return $this->product;
    }
}
