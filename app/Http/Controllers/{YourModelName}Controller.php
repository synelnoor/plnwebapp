<?php

namespace App\Http\Controllers;

use App\DataTables\{YourModelName}DataTable;
use App\Http\Requests;
use App\Http\Requests\Create{YourModelName}Request;
use App\Http\Requests\Update{YourModelName}Request;
use App\Repositories\{YourModelName}Repository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class {YourModelName}Controller extends AppBaseController
{
    /** @var  {YourModelName}Repository */
    private ${YourModelName}Repository;

    public function __construct({YourModelName}Repository ${YourModelName}Repo)
    {
        $this->middleware('auth');
        $this->{YourModelName}Repository = ${YourModelName}Repo;
    }

    /**
     * Display a listing of the {YourModelName}.
     *
     * @param {YourModelName}DataTable ${YourModelName}DataTable
     * @return Response
     */
    public function index({YourModelName}DataTable ${YourModelName}DataTable)
    {
        return ${YourModelName}DataTable->render('{_your_model_name}s.index');
    }

    /**
     * Show the form for creating a new {YourModelName}.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('{_your_model_name}s.create');
        return view('{_your_model_name}s.create');
    }

    /**
     * Store a newly created {YourModelName} in storage.
     *
     * @param Create{YourModelName}Request $request
     *
     * @return Response
     */
    public function store(Create{YourModelName}Request $request)
    {
        $input = $request->all();

        ${YourModelName} = $this->{YourModelName}Repository->create($input);

        Flash::success('{ Your Model Name} saved successfully.');

        return redirect(route('{YourModelName}s.index'));
    }

    /**
     * Display the specified {YourModelName}.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            Flash::error('{ Your Model Name} not found');

            return redirect(route('{YourModelName}s.index'));
        }

        return view('{_your_model_name}s.show')->with('{YourModelName}', ${YourModelName});
    }

    /**
     * Show the form for editing the specified {YourModelName}.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            Flash::error('{ Your Model Name} not found');

            return redirect(route('{YourModelName}s.index'));
        }

        // edited by dandisy
        // return view('{_your_model_name}s.edit')->with('{YourModelName}', ${YourModelName});
        return view('{_your_model_name}s.edit')
            ->with('{YourModelName}', ${YourModelName});        
    }

    /**
     * Update the specified {YourModelName} in storage.
     *
     * @param  int              $id
     * @param Update{YourModelName}Request $request
     *
     * @return Response
     */
    public function update($id, Update{YourModelName}Request $request)
    {
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            Flash::error('{ Your Model Name} not found');

            return redirect(route('{YourModelName}s.index'));
        }

        ${YourModelName} = $this->{YourModelName}Repository->update($request->all(), $id);

        Flash::success('{ Your Model Name} updated successfully.');

        return redirect(route('{YourModelName}s.index'));
    }

    /**
     * Remove the specified {YourModelName} from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        ${YourModelName} = $this->{YourModelName}Repository->findWithoutFail($id);

        if (empty(${YourModelName})) {
            Flash::error('{ Your Model Name} not found');

            return redirect(route('{YourModelName}s.index'));
        }

        $this->{YourModelName}Repository->delete($id);

        Flash::success('{ Your Model Name} deleted successfully.');

        return redirect(route('{YourModelName}s.index'));
    }

    /**
     * Store data {YourModelName} from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                ${YourModelName} = $this->{YourModelName}Repository->create($item->toArray());
            });
        });

        Flash::success('{ Your Model Name} saved successfully.');

        return redirect(route('{YourModelName}s.index'));
    }
}
