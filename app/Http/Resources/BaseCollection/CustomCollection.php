<?php

namespace App\Http\Resources\BaseCollection;

use App\Helpers\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


abstract class CustomCollection
{

    protected string $collectionClass;
    private array $collection = array();

    private array $arrayCollection = array();

    private $instance;
    private $DTO;


    /**
     * @throws \ReflectionException
     */
    public function __construct(Collection|array|LengthAwarePaginator $collection)
    {


        if (!isset($this->collectionClass) || !class_exists($this->collectionClass)) {
            throw new \ErrorException('Error found'); //Error message from lang files
        }

        $this->DTO = new \ReflectionClass($this->collectionClass);


        foreach ($collection as $collect) {

            $props = $this->toArray($collect);

            $instance = $this->DTO->newInstanceArgs(array_values($props));

            $this->collection[] = $instance;
            $this->arrayCollection[] = $props;

            $this->instance = $instance;
        }

        if ($collection instanceof LengthAwarePaginator) {

            $this->arrayCollection[] = [
                'currentPage' => $collection->path(),
                'perPage' => $collection->perPage(),
                'path' => $collection->path(),
                'total' => $collection->total(),
                'lastPage' => $collection->lastPage()
            ];
        }

        return $this->collection;

    }


    abstract public function toArray($collect): array;


    public function getObject(): array
    {
        return $this->collection;
    }


    protected function push($model): void
    {
        if ($model instanceof $this->instance) {
            $this->collection[] = $model;
        } else {
            throw new \ErrorException('Error found');
        }
    }

    public function addCollection(self $collection): void
    {
        $instanceCheck = new \ReflectionClass(get_class($this));
        if (!$instanceCheck->isInstance($collection)) {
            throw new \ErrorException('Error found');
        }
        $this->collection = array_merge($collection->get(), $this->collection);
    }

    public function getArray(): array
    {
        return $this->arrayCollection;
    }

}
