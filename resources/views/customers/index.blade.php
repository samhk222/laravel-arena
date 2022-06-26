@extends('adminlte::page')

@section('title', 'Customers')

@section('content_header')
    <h1>Customers</h1>
@stop

@section('content')
    <customers-index inline-template>
        <div>
            <x-card title="Create a customer">
                <customers-form @created="recordCreated" @edited="recordEdited"
                                :statuses='@json($statuses)'></customers-form>
            </x-card>


            <x-card title="List">
                <div class="form-row mb-2">
                    <div class='col-md-12'>
                        <input type="text" class="form-control" placeholder="Search by name, document or status"
                               v-on:input="debounceInput" v-model="searchInput">
                    </div>
                </div>

                <div v-if="hasRecords">
                    <customers-list :customers="records" :loading="isLoading"></customers-list>

                    <pagination align="center" :data='records' @pagination-change-page="getResults" v-if="!isLoading"
                                class="mb-2"></pagination>
                </div>

                <div v-else>
                    No records found
                </div>

            </x-card>
        </div>

    </customers-index>
@stop
