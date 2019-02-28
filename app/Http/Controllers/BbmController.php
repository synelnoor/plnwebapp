<?php

namespace App\Http\Controllers;

use App\DataTables\BbmDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateBbmRequest;
use App\Http\Requests\UpdateBbmRequest;
use App\Repositories\BbmRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class BbmController extends AppBaseController
{
    /** @var  BbmRepository */
    private $bbmRepository;

    public function __construct(BbmRepository $bbmRepo)
    {
        $this->middleware('auth');
        $this->bbmRepository = $bbmRepo;
    }

    /**
     * Display a listing of the Bbm.
     *
     * @param BbmDataTable $bbmDataTable
     * @return Response
     */
    public function index(BbmDataTable $bbmDataTable)
    {
        return $bbmDataTable->render('bbms.index');
    }

    /**
     * Show the form for creating a new Bbm.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('bbms.create');
        return view('bbms.create');
    }

    /**
     * Store a newly created Bbm in storage.
     *
     * @param CreateBbmRequest $request
     *
     * @return Response
     */
    public function store(CreateBbmRequest $request)
    {
        $input = $request->all();

        $bbm = $this->bbmRepository->create($input);

        Flash::success('Bbm saved successfully.');

        return redirect(route('bbms.index'));
    }

    /**
     * Display the specified Bbm.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            Flash::error('Bbm not found');

            return redirect(route('bbms.index'));
        }

        return view('bbms.show')->with('bbm', $bbm);
    }

    /**
     * Show the form for editing the specified Bbm.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            Flash::error('Bbm not found');

            return redirect(route('bbms.index'));
        }

        // edited by dandisy
        // return view('bbms.edit')->with('bbm', $bbm);
        return view('bbms.edit')
            ->with('bbm', $bbm);        
    }

    /**
     * Update the specified Bbm in storage.
     *
     * @param  int              $id
     * @param UpdateBbmRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBbmRequest $request)
    {
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            Flash::error('Bbm not found');

            return redirect(route('bbms.index'));
        }

        $bbm = $this->bbmRepository->update($request->all(), $id);

        Flash::success('Bbm updated successfully.');

        return redirect(route('bbms.index'));
    }

    /**
     * Remove the specified Bbm from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $bbm = $this->bbmRepository->findWithoutFail($id);

        if (empty($bbm)) {
            Flash::error('Bbm not found');

            return redirect(route('bbms.index'));
        }

        $this->bbmRepository->delete($id);

        Flash::success('Bbm deleted successfully.');

        return redirect(route('bbms.index'));
    }

    /**
     * Store data Bbm from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $bbm = $this->bbmRepository->create($item->toArray());
            });
        });

        Flash::success('Bbm saved successfully.');

        return redirect(route('bbms.index'));
    }
}
