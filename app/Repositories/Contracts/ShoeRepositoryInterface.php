<?php

namespace App\Repositories\Contracts;

interface ShoeRepositoryInterface
{
    public function getPopularShoes($limit = 4);
    public function getAllNewShoes();
    public function find($id);
    public function getPrice($ticketId);
    public function searchByName(string $keyword);
}