<?php

namespace App\Http\Controllers;

use App\DataTables\CabangDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCabangRequest;
use App\Http\Requests\UpdateCabangRequest;
use App\Repositories\CabangRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class CabangController extends AppBaseController
{
    /** @var  CabangRepository */
    private $cabangRepository;

    public function __construct(CabangRepository $cabangRepo)
    {
        $this->middleware('auth');
        $this->cabangRepository = $cabangRepo;
    }

    /**
     * Display a listing of the Cabang.
     *
     * @param CabangDataTable $cabangDataTable
     * @return Response
     */
    public function index(CabangDataTable $cabangDataTable)
    {
        return $cabangDataTable->render('cabangs.index');
    }

    /**
     * Show the form for creating a new Cabang.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('cabangs.create');
        return view('cabangs.create');
    }

    /**
     * Store a newly created Cabang in storage.
     *
     * @param CreateCabangRequest $request
     *
     * @return Response
     */
    public function store(CreateCabangRequest $request)
    {
        $input = $request->all();

        $cabang = $this->cabangRepository->create($input);

        Flash::success('Cabang saved successfully.');

        return redirect(route('cabangs.index'));
    }

    /**
     * Display the specified Cabang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            Flash::error('Cabang not found');

            return redirect(route('cabangs.index'));
        }

        return view('cabangs.show')->with('cabang', $cabang);
    }

    /**
     * Show the form for editing the specified Cabang.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            Flash::error('Cabang not found');

            return redirect(route('cabangs.index'));
        }

        // edited by dandisy
        // return view('cabangs.edit')->with('cabang', $cabang);
        return view('cabangs.edit')
            ->with('cabang', $cabang);        
    }

    /**
     * Update the specified Cabang in storage.
     *
     * @param  int              $id
     * @param UpdateCabangRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCabangRequest $request)
    {
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            Flash::error('Cabang not found');

            return redirect(route('cabangs.index'));
        }

        $cabang = $this->cabangRepository->update($request->all(), $id);

        Flash::success('Cabang updated successfully.');

        return redirect(route('cabangs.index'));
    }

    /**
     * Remove the specified Cabang from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $cabang = $this->cabangRepository->findWithoutFail($id);

        if (empty($cabang)) {
            Flash::error('Cabang not found');

            return redirect(route('cabangs.index'));
        }

        $this->cabangRepository->delete($id);

        Flash::success('Cabang deleted successfully.');

        return redirect(route('cabangs.index'));
    }

    /**
     * Store data Cabang from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $cabang = $this->cabangRepository->create($item->toArray());
            });
        });

        Flash::success('Cabang saved successfully.');

        return redirect(route('cabangs.index'));
    }
}
