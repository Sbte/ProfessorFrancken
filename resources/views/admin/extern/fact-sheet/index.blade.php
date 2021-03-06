@extends('admin.layout')
@section('page-title', 'Fact sheet')

@section('content')
    <div class="row">
        <div class="col-md-4">
            @include('admin.extern.fact-sheet._studies', ['studies' => $studies])
        </div>
        <div class="col">
            @include('admin.extern.fact-sheet._active-members', ['activeMembers' => $activeMembers])
        </div>
    </div>

    @include('admin.extern.fact-sheet._first-years', ['firstYearStudentsPerYear' => $firstYearStudentsPerYear])

    @include('admin.extern.fact-sheet._canteen-statistics', ['weeklyStats' => $weeklyStats])
    @include('admin.extern.fact-sheet._canteen-statistics', ['weeklyStats' => $monthlyStats])
@endsection
