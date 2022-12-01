<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cnnxn_Accounting;

class AccountingController extends Controller
{
    public function index()
    {
        return view('accounting.index');
    }
}
