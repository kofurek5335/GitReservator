<?php
namespace Reservator;

use Illuminate\Database\Eloquent\Model;

class CustomModel extends Model
{
    public function getValue(string $column)
    {
        return $this->$column;
    }

    public function setValue(string $column, $value): void
    {
        $this->$column = $value;
    }
}
