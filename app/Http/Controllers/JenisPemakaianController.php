<?php

namespace App\Http\Controllers;

use App\DataTables\JenisPemakaianDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateJenisPemakaianRequest;
use App\Http\Requests\UpdateJenisPemakaianRequest;
use App\Repositories\JenisPemakaianRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class JenisPemakaianController extends AppBaseController
{
    /** @var  JenisPemakaianRepository */
    private $jenisPemakaianRepository;

    public function __construct(JenisPemakaianRepository $jenisPemakaianRepo)
    {
        $this->middleware('auth');
        $this->jenisPemakaianRepository = $jenisPemakaianRepo;
    }

    /**
     * Display a listing of the JenisPemakaian.
     *
     * @param JenisPemakaianDataTable $jenisPemakaianDataTable
     * @return Response
     */
    public function index(JenisPemakaianDataTable $jenisPemakaianDataTable)
    {
        return $jenisPemakaianDataTable->render('jenis_pemakaians.index');
    }

    /**
     * Show the form for creating a new JenisPemakaian.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('jenis_pemakaians.create');
        return view('jenis_pemakaians.create');
    }

    /**
     * Store a newly created JenisPemakaian in storage.
     *
     * @param CreateJenisPemakaianRequest $request
     *
     * @return Response
     */
    public function store(CreateJenisPemakaianRequest $request)
    {
        $input = $request->all();

        $jenisPemakaian = $this->jenisPemakaianRepository->create($input);

        Flash::success('Jenis Pemakaian saved successfully.');

        return redirect(route('jenisPemakaians.index'));
    }

    /**
     * Display the specified JenisPemakaian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            Flash::error('Jenis Pemakaian not found');

            return redirect(route('jenisPemakaians.index'));
        }

        return view('jenis_pemakaians.show')->with('jenisPemakaian', $jenisPemakaian);
    }

    /**
     * Show the form for editing the specified JenisPemakaian.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            Flash::error('Jenis Pemakaian not found');

            return redirect(route('jenisPemakaians.index'));
        }

        // edited by dandisy
        // return view('jenis_pemakaians.edit')->with('jenisPemakaian', $jenisPemakaian);
        return view('jenis_pemakaians.edit')
            ->with('jenisPemakaian', $jenisPemakaian);        
    }

    /**
     * Update the specified JenisPemakaian in storage.
     *
     * @param  int              $id
     * @param UpdateJenisPemakaianRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateJenisPemakaianRequest $request)
    {
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            Flash::error('Jenis Pemakaian not found');

            return redirect(route('jenisPemakaians.index'));
        }

        $jenisPemakaian = $this->jenisPemakaianRepository->update($request->all(), $id);

        Flash::success('Jenis Pemakaian updated successfully.');

        return redirect(route('jenisPemakaians.index'));
    }

    /**
     * Remove the specified JenisPemakaian from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $jenisPemakaian = $this->jenisPemakaianRepository->findWithoutFail($id);

        if (empty($jenisPemakaian)) {
            Flash::error('Jenis Pemakaian not found');

            return redirect(route('jenisPemakaians.index'));
        }

        $this->jenisPemakaianRepository->delete($id);

        Flash::success('Jenis Pemakaian deleted successfully.');

        return redirect(route('jenisPemakaians.index'));
    }

    /**
     * Store data JenisPemakaian from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $jenisPemakaian = $this->jenisPemakaianRepository->create($item->toArray());
            });
        });

        Flash::success('Jenis Pemakaian saved successfully.');

        return redirect(route('jenisPemakaians.index'));
    }
}
