<?php

namespace App\Http\Controllers;

use App\DataTables\CatBbmDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCatBbmRequest;
use App\Http\Requests\UpdateCatBbmRequest;
use App\Repositories\CatBbmRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use Illuminate\Http\Request; // added by dandisy
use Illuminate\Support\Facades\Auth; // added by dandisy
use Illuminate\Support\Facades\Storage; // added by dandisy
use Maatwebsite\Excel\Facades\Excel; // added by dandisy

class CatBbmController extends AppBaseController
{
    /** @var  CatBbmRepository */
    private $catBbmRepository;

    public function __construct(CatBbmRepository $catBbmRepo)
    {
        $this->middleware('auth');
        $this->catBbmRepository = $catBbmRepo;
    }

    /**
     * Display a listing of the CatBbm.
     *
     * @param CatBbmDataTable $catBbmDataTable
     * @return Response
     */
    public function index(CatBbmDataTable $catBbmDataTable)
    {
        return $catBbmDataTable->render('cat_bbms.index');
    }

    /**
     * Show the form for creating a new CatBbm.
     *
     * @return Response
     */
    public function create()
    {
        // added by dandisy
        

        // edited by dandisy
        // return view('cat_bbms.create');
        return view('cat_bbms.create');
    }

    /**
     * Store a newly created CatBbm in storage.
     *
     * @param CreateCatBbmRequest $request
     *
     * @return Response
     */
    public function store(CreateCatBbmRequest $request)
    {
        $input = $request->all();

        $catBbm = $this->catBbmRepository->create($input);

        Flash::success('Cat Bbm saved successfully.');

        return redirect(route('catBbms.index'));
    }

    /**
     * Display the specified CatBbm.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            Flash::error('Cat Bbm not found');

            return redirect(route('catBbms.index'));
        }

        return view('cat_bbms.show')->with('catBbm', $catBbm);
    }

    /**
     * Show the form for editing the specified CatBbm.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        // added by dandisy
        

        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            Flash::error('Cat Bbm not found');

            return redirect(route('catBbms.index'));
        }

        // edited by dandisy
        // return view('cat_bbms.edit')->with('catBbm', $catBbm);
        return view('cat_bbms.edit')
            ->with('catBbm', $catBbm);        
    }

    /**
     * Update the specified CatBbm in storage.
     *
     * @param  int              $id
     * @param UpdateCatBbmRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCatBbmRequest $request)
    {
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            Flash::error('Cat Bbm not found');

            return redirect(route('catBbms.index'));
        }

        $catBbm = $this->catBbmRepository->update($request->all(), $id);

        Flash::success('Cat Bbm updated successfully.');

        return redirect(route('catBbms.index'));
    }

    /**
     * Remove the specified CatBbm from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $catBbm = $this->catBbmRepository->findWithoutFail($id);

        if (empty($catBbm)) {
            Flash::error('Cat Bbm not found');

            return redirect(route('catBbms.index'));
        }

        $this->catBbmRepository->delete($id);

        Flash::success('Cat Bbm deleted successfully.');

        return redirect(route('catBbms.index'));
    }

    /**
     * Store data CatBbm from an excel file in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function import(Request $request)
    {
        Excel::load($request->file('file'), function($reader) {
            $reader->each(function ($item) {
                $catBbm = $this->catBbmRepository->create($item->toArray());
            });
        });

        Flash::success('Cat Bbm saved successfully.');

        return redirect(route('catBbms.index'));
    }
}
