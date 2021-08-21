<?php

namespace App\Http\Controllers;

use App\Models\People;

class PeopleController extends Controller
{
    public function index()
    {
        $data = People::textSearch()
            ->sort()
            ->paginate();

        return response($data);
    }

    public function show(People $people)
    {
        $people->load('planet');

        return response()->json($people);
    }
}
