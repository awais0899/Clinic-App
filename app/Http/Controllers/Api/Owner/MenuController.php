<?php

namespace App\Http\Controllers\Api\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\MenuRequest;
use App\Models\Clinic;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    public function index(Clinic $clinic): JsonResponse
    {
        $services = $clinic->menu()->paginate(10);
        return response()->json($services);
    }

    public function store(MenuRequest $request, Clinic $clinic): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $menu = $clinic->menu()->create($data);

        return response()->json([
            'message' => 'Service added successfully.',
            'data' => $menu
        ], 201);
    }

    public function show(Clinic $clinic, Menu $menu): JsonResponse
    {
        return response()->json($menu);
    }

    public function update(MenuRequest $request, Clinic $clinic, Menu $menu): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $menu->update($data);

        return response()->json([
            'message' => 'Service updated successfully.',
            'data' => $menu
        ]);
    }

    public function destroy(Clinic $clinic, Menu $menu): JsonResponse
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return response()->json([
            'message' => 'Service deleted successfully.'
        ]);
    }
}
