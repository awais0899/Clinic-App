<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Http\Requests\Owner\MenuRequest;
use App\Models\Clinic;
use App\Models\Menu;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Clinic $clinic)
    {
        $services = $clinic->menu()->paginate(10);
        return view('owner.clinics.menus.index', compact('clinic', 'services'));
    }

    public function create(Clinic $clinic)
    {
        return view('owner.clinics.menus.create', compact('clinic'));
    }

    public function store(MenuRequest $request, Clinic $clinic)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $clinic->menu()->create($data);

        return redirect()->route('owner.clinics.menus.index', $clinic)
            ->with('success', 'Service added successfully.');
    }

    public function edit(Clinic $clinic, Menu $menu)
    {
        return view('owner.clinics.menus.edit', compact('clinic', 'menu'));
    }

    public function update(MenuRequest $request, Clinic $clinic, Menu $menu)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        $menu->update($data);

        return redirect()->route('owner.clinics.menus.index', $clinic)
            ->with('success', 'Service updated successfully.');
    }

    public function destroy(Clinic $clinic, Menu $menu)
    {
        if ($menu->image) {
            Storage::disk('public')->delete($menu->image);
        }

        $menu->delete();

        return redirect()->route('owner.clinics.menus.index', $clinic)
            ->with('success', 'Service deleted successfully.');
    }
}
