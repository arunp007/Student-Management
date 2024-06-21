<?php

namespace App\Http\Controllers;

use App\Http\Requests\Api\ListSectionsRequest;
use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Http\Resources\SectionResource;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function __invoke(ListSectionsRequest $request)
    {
        $sections = Section::where('class_id', $request->class_id)->get();
        
        return SectionResource::collection($sections);
    }
}
