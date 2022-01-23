<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    private $plan;

    public function __construct(Plan $plan)
    {
        $this->plan = $plan;
    }

    public function index() {
        $plans = $this->plan->latest()->paginate(5);
        return view('admin.pages.plans.index',['plans' => $plans]);
    }

    public function create() {
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request) {

        if($this->plan->create($request->all()))
            return redirect()->route('plans.index');
        else
           return redirect()->back();

    }

    public function show($id) {

        $plan = $this->plan->find($id);

        if($plan)
            return view('admin.pages.plans.show',['plan' => $plan]);
        else
            return redirect()->back();
    }

    public function destroy($id) {

        $destroy = $this->plan->destroy($id);
        if($destroy)
            return redirect()->route('plans.index');
        else
            return redirect()->back();
    }

    public function search(Request $request) {

        $filters = $request->except('_token'); //necessario enviar array para metodo append na view


        if ($request->filter) {
            $plans = $this->plan->search($request->filter);

            return view('admin.pages.plans.index',[
                'plans'     => $plans,
                'filters'   => $filters,
            ]);

        } else
            //chama a rota index
            return redirect()->route('plans.index');

    }

    public function edit($id) {
        //echo "Esse é o id: {$id}";
        $plan = $this->plan->find($id);

        if (!$plan)
            return redirect()->back();
        else
            return view('admin.pages.plans.edit',['plan' => $plan]);
    }

    public function update(StoreUpdatePlan $request, $id) {

        $data =  $request->except('_token');
        $plan = $this->plan->find($id);

        if (!$plan)
            return redirect()->back();
        else {
            $plan->update($data);
            return redirect()->route('plans.index');
        }

    }
}
