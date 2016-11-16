<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactListRequest;
use App\Repositories\ContactListRepository;
use Illuminate\Http\Request;

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
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $rules = [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required|unique:contacts_list,phone_number',
                'email' => 'required|unique:contacts_list,email|email',
                'birthday_date' => 'required|date',
                'basic_info' => 'required'
            ];
            $validator = app('validator')->make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'code'      =>  422,
                    'errors'    =>  $validator->errors()
                ]);
            }

            $date = date("Y-m-d", strtotime($request->birthday_date));
            $request['birthday_date'] = $date;
            $this->contactListRepository->create($request->all());
        } catch (\Exception $e) {
            return response()->json([
                'status' => $e->getCode(),
                'error' => $e->getMessage()
            ]);
        }

        return response()->json([
            'status' => 200
        ]);
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
