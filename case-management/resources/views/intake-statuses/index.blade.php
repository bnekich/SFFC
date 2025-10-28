@extends('layouts.app')

@section('title')
    - Intake Statuses
@endsection

@section('content')

@section('header')
    Intake Statuses
@endsection
<div class="container mx-auto p-6 max-w-4xl">

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Table -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                <h2 class="text-lg font-semibold">Categories</h2>
                <button onclick="handleCreateMode()"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded text-sm font-medium transition">
                    Add New
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($intakeStatuses as $intakeStatus)
                            <tr class="hover:bg-gray-50 cursor-pointer transition"
                                onclick="handleRowClick(this, {{ $intakeStatus->id }}, '{{ addslashes($intakeStatus->name) }}')">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intakeStatus->id }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $intakeStatus->name }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Form -->
        <div x-data="categoryForm()" class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold mb-4" x-text="isEditing ? 'Edit Category' : 'Create Category'"></h2>

            <form :action="formAction" method="POST" @submit.prevent="submitForm">
                @csrf
                <input type="hidden" name="_method" x-bind:value="isEditing ? 'PUT' : 'POST'" x-show="isEditing">
                <input type="hidden" name="id" x-model="categoryId" x-show="isEditing">
                {{-- <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">ID</label>
                    <input type="text" x-model="categoryId"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                        readonly>
                </div> --}}

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <input type="text" name="name" x-model="categoryName" required x-ref="nameInput"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Enter category name">
                </div>

                <div class="flex gap-3">
                    <button type="submit"
                        class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2 px-4 rounded transition">
                        <span x-text="isEditing ? 'Update' : 'Create'"></span>
                    </button>

                    <button type="button" onclick="handleCreateMode()"
                        class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-medium py-2 px-4 rounded transition">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Global handler to access Alpine component
    function getFormData() {
        const form = document.querySelector('[x-data="categoryForm()"]');
        return form?._x_dataStack?.[0] || null;
    }

    function handleRowClick(el, id, name) {
        const data = getFormData();
        if (data) {
            data.selectCategory(id, name);
            setTimeout(() => data.$refs.nameInput?.focus(), 0);
        }
    }

    function handleCreateMode() {
        const data = getFormData();
        if (data) {
            data.setCreateMode();
            setTimeout(() => data.$refs.nameInput?.focus(), 0);
        }
    }

    // Your Alpine component (unchanged)
    function categoryForm() {
        return {
            categoryId: '',
            categoryName: '',
            isEditing: false,
            formAction: '{{ route('intake-statuses.store') }}',

            selectCategory(id, name) {
                this.categoryId = id;
                this.categoryName = name;
                this.isEditing = true;
                this.formAction = `{{ route('intake-statuses.update', ':id') }}`.replace(':id', id);
            },

            setCreateMode() {
                this.categoryId = '';
                this.categoryName = '';
                this.isEditing = false;
                this.formAction = '{{ route('intake-statuses.store') }}';
            },

            submitForm(e) {
                e.target.submit();
            }
        };
    }
</script>
@endsection
