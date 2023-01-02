<?php

namespace App\Http\Controllers;

use App\Models\Spending;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Spending/Index', [
            'spending' => Spending::with('user:id,name')->where("user_id", auth()->id())->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if($request->input("opType") == "create") {
            $validated = $request->validate([
                'date' => 'required|date',
                'name' => 'required|string|max:255',
                'kind' => 'required|string|max:255',
                'image' => 'url|nullable',
                'cost' => 'required|integer',
                'info' => 'required|string|max:255',
            ]);
            $validated = array_filter($validated);

            $request->user()->spending()->create($validated);
            return redirect(route('spending.index'));
        }elseif ($request->input("opType") == "search"){
            $listing = $this->searchProcess($request);

            return Inertia::render('Spending/Index', [
                'spending' =>$listing->latest()->get(),
            ]);
        }elseif ($request->input("opType") == "whatToEat") {
            $listing = $this->searchProcess($request);

            return Inertia::render('Spending/Index', [
                'spending' => $listing->inRandomOrder()->take(1)->get(),
            ]);
        }else{
            return redirect(route('spending.index'));
        }


    }

    private function searchProcess(Request $request) {
        $validated = $request->validate([
            'date' => 'date|nullable',
            'name' => 'string|max:255|nullable',
            'kind' => 'string|max:255|nullable',
            'image' => 'url|nullable',
            'cost' => 'integer|nullable',
            'info' => 'string|max:255|nullable',
        ]);
        $validated = array_filter($validated);
        $listing = Spending::with('user:id,name')->where("user_id", auth()->id());
        foreach ($validated as $key => $value) {
            $listing->where($key, "like", "%".$value."%");
        }

        return $listing;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function show(Spending $spending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function edit(Spending $spending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spending $spending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spending  $spending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spending $spending)
    {
        $this->authorize('delete', $spending);

        $spending->delete();

        return redirect(route('spending.index'));
    }
}
