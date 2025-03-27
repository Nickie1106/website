<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminGenresController extends Controller
{
    public function index()
    {
        $genres = [
            ['id' => 0, 'name' => '総記', 'description' => '総記に関する書籍'],
            ['id' => 1, 'name' => '哲学', 'description' => '哲学に関する書籍'],
            ['id' => 2, 'name' => '歴史', 'description' => '歴史に関する書籍'],
        ];

        return view('admin.genres.index', compact('genres'));
    }
}
