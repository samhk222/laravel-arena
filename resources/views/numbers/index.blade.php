@extends('adminlte::page')

@section('title', 'Numbers')

@section('content_header')
    <h1>Numbers</h1>
@stop

@section('content')
    <numbers-index :customer-id="{{ isset($customer) ? $customer->id : 'null'}}" inline-template>
        <div>
            <x-card title="Numbers">
                <numbers-form @created="recordCreated" @edited="recordEdited"
                              :customer-id="{{isset($customer) ? $customer->id: 'null'}}"
                              :statuses='@json($statuses)'></numbers-form>
            </x-card>


            <x-card title="List">
                <div class="form-row mb-2">
                    <div class='col-md-12'>
                        <input type="text" class="form-control" placeholder="Search by number, customer or status"
                               v-on:input="debounceInput" v-model="searchInput">
                    </div>
                </div>

                <div v-if="hasRecords">
                    <numbers-list :numbers="records" :loading="isLoading"></numbers-list>

                    <pagination align="center" :data='records' @pagination-change-page="getResults" v-if="!isLoading"
                                class="mb-2"></pagination>
                </div>

                <div v-else>
                    No numbers found
                </div>

            </x-card>

        </div>
    </numbers-index>
@stop
