<?php

namespace MEPDatabaseTask\models;

class ProductForm
{
    public string $name;
    public string $category;
    public string $description;
    public ?int $id;

    /**
     * @param string $name
     * @param string $category
     * @param string $description
     * @param int|null $id
     */
    public function __construct(
        string $name,
        string $category,
        string $description,
        ?int $id = null
    ) {
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->id = $id;
    }

    public function validate(): bool
    {
        if (empty($this->name) ||
            empty($this->category) ||
            strlen($this->name) > 64 ||
            strlen($this->category) > 64 ||
            strlen($this->description) > 500)
        {
            return false;
        }
        return true;
    }

}
