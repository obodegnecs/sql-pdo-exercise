<?php

namespace MEPDatabaseTask\models;

class ProductForm
{
    public string $name;
    public string $category;
    public string $description;
    public ?int $id;

    public function validate(string $name, string $category,
        string $description, ?int $id = null
    ): bool {
        $this->name = $name;
        $this->category = $category;
        $this->description = $description;
        $this->id = $id;

        if (empty($this->name) || empty($this->category)) {
            return false;
        } elseif (strlen($this->name) > 64) {
            return false;
        } elseif (strlen($this->description) > 500) {
            return false;
        }

        return true;
    }

}
