<?php

namespace App\Http\Controllers;

use App\DataTables\JabatanDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJabatanRequest;
use App\Http\Requests\UpdateJabatanRequest;
use App\Repositories\JabatanRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class JabatanController extends AppBaseController
{
    /** @var  JabatanRepository */
    private $jabatanRepository;

    public function __construct(JabatanRepository $jabatanRepo)
    {
        $this->middleware('auth');
        $this->jabatanRepository = $jabatanRepo;
    }

    /**
     * Display a listing of the Jabatan.
     *
     * @param JabatanDataTable $jabatanDataTable
     * @return Response
     */
    public function index(JabatanDataTable $jabatanDataTable)
    {
        return $jabatanDataTable->render('jabatans.index');
    }

    /**
     * Show the form for creating a new Jabatan.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('jabatans.create');
        return view('jabatans.create');
    }

    /**
     * Store a newly created Jabatan in storage.
     *
     * @param CreateJabatanRequest $request
     *
     * @return Response
     */
    public function store(CreateJabatanRequest $request)
    {
        $input = $request->all();

        $jabatan = $this->jabatanRepository->create($input);

        Flash::success('Jabatan saved successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Display the specified Jabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        return view('jabatans.show')->with('jabatan', $jabatan);
    }

    /**
     * Show the form for editing the specified Jabatan.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        // edited by dandisy
        // return view('jabatans.edit')->with('jabatan', $jabatan);
        return view('jabatans.edit')
            ->with('jabatan', $jabatan);        
    }

    /**
     * Update the specified Jabatan in storage.
     *
     * @param  int              $id
     * @param UpdateJabatanRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJabatanRequest $request)
    {
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $jabatan = $this->jabatanRepository->update($request->all(), $id);

        Flash::success('Jabatan updated successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Remove the specified Jabatan from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jabatan = $this->jabatanRepository->findWithoutFail($id);

        if (empty($jabatan)) {
            Flash::error('Jabatan not found');

            return redirect(route('jabatans.index'));
        }

        $this->jabatanRepository->delete($id);

        Flash::success('Jabatan deleted successfully.');

        return redirect(route('jabatans.index'));
    }

    /**
     * Store data Jabatan from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $jabatan = $this->jabatanRepository->create($item->toArray());
            });
        });

        Flash::success('Jabatan saved successfully.');

        return redirect(route('jabatans.index'));
    }
}
