<?php

namespace App\Http\Controllers;

use App\Models\Committee;
use App\Http\Resources\Committee as CommitteeResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{

    public function index()
    {
        return CommitteeResource::collection(Committee::all());
    }

    public function store(Request $request)
    {
        $validator = $this->validateCommittee($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $committee = Committee::create($request->all());

        $data = [
            'data' => new CommitteeResource($committee),
            'status' => (bool)$committee,
            'message' => $committee ? 'Committee Created!' : 'Error Creating Committee',
        ];

        return response()->json($data);
    }

    public function show(Committee $committee)
    {
        return new CommitteeResource($committee);
    }


    public function update(Request $request, Committee $committee)
    {
        $validator = $this->validateCommittee($request->all());

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        $committee->fill($request->all())->save();

        $data = [
            'data' => new CommitteeResource($committee),
            'status' => (bool)$committee,
            'message' => $committee ? 'Committee Updated!' : 'Error Updating Committee',
        ];

        return response()->json($data);
    }

    public function destroy(Committee $committee)
    {
        $committee->delete();


        $data = [
            'status' => (bool)$committee,
            'message' => $committee ? 'Commitee Deleted!' : 'Error Deleting Committee',
        ];

        // I prefer to send a 200 with a message when deleting a record. I know others prefer a 204
        // but I think it's better to tell the front end what happened so they can take action
        return response()->json($data, 200);
    }

    private function validateCommittee($data)
    {
        return Validator::make($data, [
            'committee_name' => 'required|string|max:255'
        ]);
    }
}
