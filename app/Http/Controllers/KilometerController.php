<?php

namespace App\Http\Controllers;

use App\DataTables\KilometerDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateKilometerRequest;
use App\Http\Requests\UpdateKilometerRequest;
use App\Repositories\KilometerRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class KilometerController extends AppBaseController
{
    /** @var  KilometerRepository */
    private $kilometerRepository;

    public function __construct(KilometerRepository $kilometerRepo)
    {
        $this->middleware('auth');
        $this->kilometerRepository = $kilometerRepo;
    }

    /**
     * Display a listing of the Kilometer.
     *
     * @param KilometerDataTable $kilometerDataTable
     * @return Response
     */
    public function index(KilometerDataTable $kilometerDataTable)
    {
        return $kilometerDataTable->render('kilometers.index');
    }

    /**
     * Show the form for creating a new Kilometer.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('kilometers.create');
        return view('kilometers.create');
    }

    /**
     * Store a newly created Kilometer in storage.
     *
     * @param CreateKilometerRequest $request
     *
     * @return Response
     */
    public function store(CreateKilometerRequest $request)
    {
        $input = $request->all();

        $kilometer = $this->kilometerRepository->create($input);

        Flash::success('Kilometer saved successfully.');

        return redirect(route('kilometers.index'));
    }

    /**
     * Display the specified Kilometer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            Flash::error('Kilometer not found');

            return redirect(route('kilometers.index'));
        }

        return view('kilometers.show')->with('kilometer', $kilometer);
    }

    /**
     * Show the form for editing the specified Kilometer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            Flash::error('Kilometer not found');

            return redirect(route('kilometers.index'));
        }

        // edited by dandisy
        // return view('kilometers.edit')->with('kilometer', $kilometer);
        return view('kilometers.edit')
            ->with('kilometer', $kilometer);        
    }

    /**
     * Update the specified Kilometer in storage.
     *
     * @param  int              $id
     * @param UpdateKilometerRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateKilometerRequest $request)
    {
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            Flash::error('Kilometer not found');

            return redirect(route('kilometers.index'));
        }

        $kilometer = $this->kilometerRepository->update($request->all(), $id);

        Flash::success('Kilometer updated successfully.');

        return redirect(route('kilometers.index'));
    }

    /**
     * Remove the specified Kilometer from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $kilometer = $this->kilometerRepository->findWithoutFail($id);

        if (empty($kilometer)) {
            Flash::error('Kilometer not found');

            return redirect(route('kilometers.index'));
        }

        $this->kilometerRepository->delete($id);

        Flash::success('Kilometer deleted successfully.');

        return redirect(route('kilometers.index'));
    }

    /**
     * Store data Kilometer from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $kilometer = $this->kilometerRepository->create($item->toArray());
            });
        });

        Flash::success('Kilometer saved successfully.');

        return redirect(route('kilometers.index'));
    }
}
