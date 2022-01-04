<?php


class FilterByMeta
{

    //implement closure handler
    public function handle($request,\Closure $next)
    {
        //retrieve the query builder
        $builder = $next($request);

        //check if not super admin, then apply filters based on the consumer type
        if (auth()->user()->user_type != env('SUPERADMIN_ROLE_ID')){

            if (auth()->user()->consumer_type == 'RWS') {

                $builder->where('job_type', '=', 'rws');

            } else {
                $builder->where('job_type', '=', 'unpaid');
            }

        }

        if (request('job_type') && request('job_type') != '') {
            $builder->whereIn('job_type', request('job_type'));
            /*$allJobs->where('jobs.job_type', '=', $requestdata['job_type']);*/
        }

        if (request('physical') && request('physical') !='') {
            $builder->where('customer_physical_type', request('physical'));
            $builder->where('ignore_physical', 0);
        }

        if (request('phone')) {
            $builder->where('customer_phone_type', request('phone'));
            if(request('physical'))
                $builder->where('ignore_physical_phone', 0);
        }

        if (request('flagged')) {
            $builder->where('flagged', request('flagged'));
            $builder->where('ignore_flagged', 0);
        }

        if (request('distance') && request('distance') == 'empty') {
            $builder->whereDoesntHave('distance');
        }

        if(request('salary') &&  request('salary') == 'yes') {
            $builder->whereDoesntHave('user.salaries');
        }

        //booking type
        if (request('booking_type')) {

            if (request('booking_type') == 'physical')
                $builder->where('customer_physical_type', 'yes');

            else if (request('booking_type') == 'phone')
                $builder->where('customer_phone_type', 'yes');
        }


        return $builder;
    }

}