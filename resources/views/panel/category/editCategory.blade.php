@extends('panel.master')

@section('content')
    <hr/>

    <div class="row">
        <div class="col-lg-12">
            <hr/>
            <div class="well">
                {!! Form::open( [ 'url'=>'category/update', 'method' =>'POST', 'class' =>'form-horizontal', 'name'=>'editCategoryForm' ] ) !!}
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Category Name <span
                                class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" value="{{ $categoryByID->categoryName }}" class="form-control"
                               name="categoryName" required>
                        <input type="hidden" value="{{ $categoryByID->id }}" class="form-control" name="categoryId">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Category Description <span
                                class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" name="categoryDescription"
                                  rows="8" required>{{ $categoryByID->categoryDescription }}</textarea>
                    </div>
                </div>
                {{--<div class="form-group">--}}
                {{--<label for="inputPassword3" class="col-sm-2 control-label">Publication Status</label>--}}
                {{--<div class="col-sm-10">--}}
                {{--<select class="form-control" name="publicationStatus">--}}
                {{--<option>Select Publication Status</option>--}}
                {{--<option value="1">Published</option>--}}
                {{--<option value="0">Unpublished</option>--}}
                {{--</select>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" name="btn" class="btn btn-success btn-block">Update Category Info</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <script>
        document.forms['editCategoryForm'].elements['publicationStatus'].value ={{ $categoryByID->publicationStatus }}
    </script>

@endsection