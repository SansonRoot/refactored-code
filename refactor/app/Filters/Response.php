<?php


class Response
{

    public static function paginate($query)
    {

        //confirm if query is a valid query and not a count result
        if (is_numeric($query)) return $query;

        $limit = request('limit');

        //no pagination of data required
        if (isset($limit) && $limit == 'all'){

            return $query->get();

        }else{ //apply default pagination

            return $query->paginate(15);
        }
        
    }

}