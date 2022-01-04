<?php


class FilterByCustomer
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        //handle issue of single customer email or multiple emails sent
        $customers = request('customer_email');
        if ($customers && !is_array($customers))
            $customers = [$customers];

        if ($customers && count($customers) && $customers != '') {
            $users = DB::table('users')->whereIn('email', $customers)->get();
            if ($users) {
                $builder->whereIn('user_id', collect($users)->pluck('id')->all());
            }
        }

        if (request('consumer_type') && request('consumer_type') != '') {
            $c_type = request('consumer_type');
            $builder->whereHas('user.userMeta', function($q) use ($c_type) {
                $q->where('consumer_type', $c_type);
            });
        }

        return $builder;
    }
}