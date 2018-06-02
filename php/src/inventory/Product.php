<?php
namespace inventory;

class Product {
    private $id;
    private $productId;
    private $name;
    private $description;
    private $quantity;
    private $image;
    private $price;
    private $sale;

    function __construct(int $id, int $productId, string $name, string $description, int $quantity = 0,
        ?string $image = null, int $price = 0, int $sale = 100) {

        $this->id = $id;
        $this->productId = $productId;
        $this->name = $name;
        $this->description = $description;
        $this->quantity = $quantity;
        $this->image = $image;
        $this->price = $price;
        $this->sale = $sale;
    }

    /**
     * Getter for id
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Getter for productId
     *
     * @return string
     */
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Getter for name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Getter for description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Getter for quantity
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Getter for image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Getter for price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Getter for sale
     *
     * @return string
     */
    public function getSale()
    {
        return $this->sale;
    }

    /**
     * getSalePrice
     * Returns the product of getPrice() and getSale()
     *
     */
    function getSalePrice() {
        return self::getPrice() * self::getSale();
    }

    function toArray() : array {
        return array(
            "id" => $this->getId(),
            "productId" => $this->getProductId(),
            "name" => $this->getName(),
            "description" => $this->getDescription(),
            "quantity" => $this->getQuantity(),
            "image" => $this->getImage(),
            "price" => $this->getPrice(),
            "sale" => $this->getSale()
        );
    }
}
