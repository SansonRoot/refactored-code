<?php


class FilterById
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        if (request('id') && request('id') != '') {
            if (is_array(request('id')))
                $builder->whereIn('id', request('id'));
            else
                $builder->where('id', request('id'));

//            $requestdata = array_only($requestdata, ['id']);
        }

        return $builder;
    }



}