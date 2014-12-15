<?php
// src/AppBundle/Entity/Product.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="pizza")
 */
class Pizza
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumn(name="customerId", referencedColumnName="id", nullable=true)
     **/
    protected $customer;
    
    /**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
    protected $price;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $toppingOne;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $toppingTwo;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $toppingThree;

    /**
     * @ORM\Column(type="text")
     */
    protected $orderId;

    /**
     * @var \DateTime $created
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var \DateTime $updated
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(type="datetime")
     */
    private $updated;

    /**
     * @var \DateTime $contentChanged
     *
     * @ORM\Column(name="contentChanged", type="datetime", nullable=true)
     * @Gedmo\Timestampable(on="change", field={"title", "body"})
     */
    private $contentChanged;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Pizza
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set toppingOne
     *
     * @param boolean $toppingOne
     * @return Pizza
     */
    public function setToppingOne($toppingOne)
    {
        $this->toppingOne = $toppingOne;

        return $this;
    }

    /**
     * Get toppingOne
     *
     * @return boolean 
     */
    public function getToppingOne()
    {
        return $this->toppingOne;
    }

    /**
     * Set toppingTwo
     *
     * @param boolean $toppingTwo
     * @return Pizza
     */
    public function setToppingTwo($toppingTwo)
    {
        $this->toppingTwo = $toppingTwo;

        return $this;
    }

    /**
     * Get toppingTwo
     *
     * @return boolean 
     */
    public function getToppingTwo()
    {
        return $this->toppingTwo;
    }

    /**
     * Set toppingThree
     *
     * @param boolean $toppingThree
     * @return Pizza
     */
    public function setToppingThree($toppingThree)
    {
        $this->toppingThree = $toppingThree;

        return $this;
    }

    /**
     * Get toppingThree
     *
     * @return boolean 
     */
    public function getToppingThree()
    {
        return $this->toppingThree;
    }

    /**
     * Set customer
     *
     * @param \AppBundle\Entity\Customer $customer
     * @return Pizza
     */
    public function setCustomer(\AppBundle\Entity\Customer $customer = null)
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * Get customer
     *
     * @return \AppBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set orderId
     *
     * @param string $orderId
     * @return Pizza
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;

        return $this;
    }

    /**
     * Get orderId
     *
     * @return string 
     */
    public function getOrderId()
    {
        return $this->orderId;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Pizza
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     * @return Pizza
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime 
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set contentChanged
     *
     * @param \DateTime $contentChanged
     * @return Pizza
     */
    public function setContentChanged($contentChanged)
    {
        $this->contentChanged = $contentChanged;

        return $this;
    }

    /**
     * Get contentChanged
     *
     * @return \DateTime 
     */
    public function getContentChanged()
    {
        return $this->contentChanged;
    }
}
