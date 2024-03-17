<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Relative;
use App\Models\Relationship;

class RelativeController extends Controller
{
    public function getRelativesAndRelationships($userId)
    {
        $relationships = Relationship::where('manv', $userId)->get();

        if ($relationships->isEmpty()) {
            return response()->json(['message' => 'Employee not found or has no relatives'], 404);
        }

        $relativeIds = $relationships->pluck('matn')->toArray();

        $relatives = Relative::whereIn('id', $relativeIds)->get();

        $result = [];

        foreach ($relatives as $relative) {
            $relativeData = [
                'relative_info' => $relative,
                'relationships' => $relationships->where('matn', $relative->id)->pluck('loaiquanhe')->toArray(),
            ];

            $result[] = $relativeData;
        }

        return response()->json(['employee_id' => $userId, 'relatives' => $result]);
    }
    public function getRelative()
    {
        $relative = Relative::all();
        return response()->json(['relatives' => $relative], 200);
    }
    public function getRelationship()
    {
        $relation = Relationship::all();
        return response()->json(['relatives' => $relation], 200);
    }


    public function createRelative(Request $request)
    {
        // Validate request data
        $request->validate([
            'hotentn' => 'required|string',
            'ngaysinh' => 'required|date',
            'diachi' => 'required|string',
            'userId' => 'required|integer', // Thêm quy tắc xác thực cho trường userId
            'relationship' => 'required|string' // Thêm quy tắc xác thực cho trường relationship
        ]);

        // Create Relative
        $relative = Relative::create([
            'hotentn' => $request->input('hotentn'),
            'ngaysinh' => $request->input('ngaysinh'),
            'diachi' => $request->input('diachi')
        ]);

        // Attach relationship with user
        $userId = $request->input('userId');
        $relationshipType = $request->input('relationship');

        // Tìm người dùng có id tương ứng và kiểm tra xem nó tồn tại hay không
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Tạo một mối quan hệ mới
        $relationship = new Relationship();
        $relationship->manv = $userId;
        $relationship->matn = $relative->id; // Sử dụng id của relative vừa tạo
        $relationship->loaiquanhe = $relationshipType;
        $relationship->save();

        // Return response with relative and relationship data
        return response()->json([
            'message' => 'Relative created successfully',
            'relative' => $relative,
            'relationship' => $relationship
        ], 201);
    }

    public function deleteRelative($id)
    {
        try {
            // Tìm người thân cần xóa
            $relativeToDelete = Relative::find($id);

            // Kiểm tra xem người thân tồn tại hay không
            if (!$relativeToDelete) {
                return response()->json([
                    'status' => false,
                    'message' => 'Relative not found.',
                ], 404);
            }

            // Thực hiện xóa người thân
            $relativeToDelete->delete();

            return response()->json([
                'status' => true,
                'message' => 'Relative deleted successfully.',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }
}
