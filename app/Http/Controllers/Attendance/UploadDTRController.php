<?php

namespace App\Http\Controllers\Attendance\Raw;

use function Couchbase\defaultDecoder;
use DateTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SplFileObject;

class ImportRawController extends Controller
{
    public function index()
    {
        return view('admin.uploadDTR.index');
    }

    function store($path)
    {

    }
}
