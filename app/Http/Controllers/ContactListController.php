<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactListRequest;
use App\Repositories\ContactListRepository;

class ContactListController extends Controller
{
    /**
     * @var ContactListRepository
     */
    private $contactListRepository;

    /**
     * ContactListController constructor.
     * @param ContactListRepository $contactListRepository
     */
    public function __construct(ContactListRepository $contactListRepository)
    {
        $this->contactListRepository = $contactListRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $allContacts = $this->contactListRepository->getAll();
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return response()->json([
            'allContacts' => $allContacts
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
     * @param  ContactListRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactListRequest $request)
    {
        try {
            $this->contactListRepository->create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $contact = $this->contactListRepository->getById($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return response()->json([
            'contact' => $contact
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactListRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactListRequest $request, $id)
    {
        try {
            $this->contactListRepository->update($id, $request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return $this->show($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->contactListRepository->delete($id);
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return $this->index();
    }
}
