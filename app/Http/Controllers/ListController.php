<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Exception;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function show(Listing $listing) {
        return response()->json($listing,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $assets = Listing::where('prop_type','like',"%$request->key%")
            ->orWhere('prop_category','like',"%$request->key%")->get();

        return response()->json($listings, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'prop_type' => 'string|required',
            'prop_category' => 'string|required',
            'location'=> 'string|required',
            'value' => 'numeric|required',
            'description' => 'string|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $listing = Listing::create($request->all());
            return response()->json($listing, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Listing $listing) {
        try {
            $listing->update($request->all());
            return response()->json($listing, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Listing $listing) {
        $listing->delete();
        return response()->json(['message'=>'Listing deleted.'],202);
    }

    public function index() {
        $listings = Listing::orderBy('prop_type')->get();
        return response()->json($listings, 200);
    }
}
