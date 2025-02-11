<?php

namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\ShoeRepositoryInterface;

class FrontService 
{
    protected $categoryRepository;
    protected $shoeRepository;


    public function  __construct(CategoryRepositoryInterface $categoryRepository, ShoeRepositoryInterface $shoeRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->shoeRepository = $shoeRepository;
    }

    public function searchShoes(string $keyword)
    {
        return $this->shoeRepository->searchByName($keyword);
    }

    public function getFrontPageData()
    {
        $popularShoes = $this->shoeRepository->getPopularShoes();
        $categories = $this->categoryRepository->getAllCategories();
        $newShoes = $this->shoeRepository->getAllNewShoes();
        return compact('categories','popularShoes', 'newShoes');
    }
}