<?php 

namespace App\Repositories;
use App\Models\Brand;
use App\Repositories\Contracts\BrandRepositoryInterface;

class BrandRepository extends AbstractRepository implements BrandRepositoryInterface
{   
    protected $model = Brand::class;

   
}