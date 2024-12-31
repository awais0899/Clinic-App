@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">My Clinics</h1>
        <a href="{{ route('owner.clinics.create') }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Clinic
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded my-6">
        <table class="min-w-full">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-left">Category</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clinics as $clinic)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-4 px-6">{{ $clinic->name }}</td>
                        <td class="py-4 px-6">{{ $clinic->category->name }}</td>
                        <td class="py-4 px-6">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $clinic->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $clinic->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex space-x-2">
                                <a href="{{ route('owner.clinics.edit', $clinic) }}" 
                                   class="text-blue-600 hover:text-blue-900">Edit</a>
                                
                                <form action="{{ route('owner.clinics.destroy', $clinic) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-6 text-center text-gray-500">
                            No clinics found. Create your first clinic!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $clinics->links() }}
    </div>
</div>
@endsection