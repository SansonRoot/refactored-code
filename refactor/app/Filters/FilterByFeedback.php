<?php


class FilterByFeedback
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        //access filters through the global request() function
        if (request('feedback') && request('feedback') != 'false') {

            $builder->where('ignore_feedback', '0');
            $builder->whereHas('feedback', function ($q) {
                $q->where('rating', '<=', '3');
            });

        }

        return $builder;
    }
}