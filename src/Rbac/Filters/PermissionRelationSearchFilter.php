<?php

namespace QuadStudio\Rbac\Filters;

use QuadStudio\Repo\Contracts\RepositoryInterface;
use QuadStudio\Repo\Filters\SearchFilter;
use QuadStudio\Repo\Filters\BootstrapInput;

class PermissionRelationSearchFilter extends SearchFilter
{

    use BootstrapInput;

    protected $render = true;
    protected $search = 'search_permission';

    public function label()
    {
        return trans('rbac::permission.placeholder.search');
    }

    function apply($builder, RepositoryInterface $repository)
    {
        if ($this->canTrack()) {
            if (!empty($this->columns())) {
                $words = $this->split($this->get($this->search));
                if (!empty($words)) {
                    $builder = $builder->whereHas('permissions', function ($query) use ($words) {
                        foreach ($words as $word) {
                            $query->where(function ($query) use ($word) {
                                foreach ($this->columns() as $column){
                                    $query->orWhereRaw("LOWER({$column}) LIKE LOWER(?)", ["%{$word}%"]);
                                }
                            });
                        }
                    });
                }
            }
        }

        return $builder;
    }

    protected function columns()
    {
        return [
            'name',
            'title',
            'description'
        ];
    }

}