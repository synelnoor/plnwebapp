<?php

namespace App\Http\Controllers;

use App\DataTables\StatusDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateStatusRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Repositories\StatusRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class StatusController extends AppBaseController
{
    /** @var  StatusRepository */
    private $statusRepository;

    public function __construct(StatusRepository $statusRepo)
    {
        $this->middleware('auth');
        $this->statusRepository = $statusRepo;
    }

    /**
     * Display a listing of the Status.
     *
     * @param StatusDataTable $statusDataTable
     * @return Response
     */
    public function index(StatusDataTable $statusDataTable)
    {
        return $statusDataTable->render('statuses.index');
    }

    /**
     * Show the form for creating a new Status.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('statuses.create');
        return view('statuses.create');
    }

    /**
     * Store a newly created Status in storage.
     *
     * @param CreateStatusRequest $request
     *
     * @return Response
     */
    public function store(CreateStatusRequest $request)
    {
        $input = $request->all();

        $status = $this->statusRepository->create($input);

        Flash::success('Status saved successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Display the specified Status.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        return view('statuses.show')->with('status', $status);
    }

    /**
     * Show the form for editing the specified Status.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        // edited by dandisy
        // return view('statuses.edit')->with('status', $status);
        return view('statuses.edit')
            ->with('status', $status);        
    }

    /**
     * Update the specified Status in storage.
     *
     * @param  int              $id
     * @param UpdateStatusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateStatusRequest $request)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $status = $this->statusRepository->update($request->all(), $id);

        Flash::success('Status updated successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Remove the specified Status from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $status = $this->statusRepository->findWithoutFail($id);

        if (empty($status)) {
            Flash::error('Status not found');

            return redirect(route('statuses.index'));
        }

        $this->statusRepository->delete($id);

        Flash::success('Status deleted successfully.');

        return redirect(route('statuses.index'));
    }

    /**
     * Store data Status from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $status = $this->statusRepository->create($item->toArray());
            });
        });

        Flash::success('Status saved successfully.');

        return redirect(route('statuses.index'));
    }
}
