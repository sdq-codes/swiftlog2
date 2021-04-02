<?php

namespace App\Repositories;


use App\Models\Rider;
use App\Repositories\Interfaces\RiderRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RiderRepository extends BaseRepository implements RiderRepositoryInterface
{
    public function __construct(Rider $model) {
        parent::__construct($model);
    }

    public function create(array $data): Rider {
        return $this->model->create($data);
    }

    public function all(): Collection {
        return $this->model->with('guarantors', 'user', 'bike')->get();
    }
}
