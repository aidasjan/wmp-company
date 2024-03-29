@extends('layouts.app')

@section('content')
<div class='container'>
    <div class='row py-5'>
        <div class='col container_grey py-5'>
            <h1>ADD CATEGORY</h1>
            <form action='{{ action('App\Http\Controllers\CategoriesController@store')}}' method='POST'>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Code</label>
                    <input type='text' value='' name='code' class='form-control' required>
                </div>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Category name EN</label>
                    <input type='text' value='' name='name' class='form-control' required>
                </div>
                <div class='form-group col-md-6 offset-md-3 align-self-center'>
                    <label>Category name RU</label>
                    <input type='text' value='' name='name_ru' class='form-control' required>
                </div>
                <div class='form-group col-md-4 offset-md-4 align-self-center'>
                    <label>Discount (%)</label>
                    <input type='number' step='any' min='0' max='100' value='0' name='discount' class='form-control' required>
                </div>
                @if ($parentId !== null) <input type='hidden' value='{{$parentId}}' name='parent_id'> @endif
                {{csrf_field()}}
                <button type='submit' class='btn btn-primary'>SAVE CATEGORY</button>
            </form>
        </div>
    </div>
</div>
@endsection