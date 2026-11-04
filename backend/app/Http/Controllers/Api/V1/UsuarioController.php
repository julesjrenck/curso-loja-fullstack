<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsuarioResource;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function show(Request $request): UsuarioResource
    {
        return new UsuarioResource($request->user());
    }
}
