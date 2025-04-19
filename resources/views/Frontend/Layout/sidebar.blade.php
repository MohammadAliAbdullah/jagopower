<div class="col-12 col-md-3">
    <div class="sidebar">
        <h4>Brand: </h4>
        <ul>
            @foreach(brandh() as $brand)
                <li>
                    <label>
                        <input type="checkbox" class="sort_rang brand" id="brand" name="brand[]" value="{{ $brand->id }}"> {{ $brand->title ?? 'N/A' }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="sidebar">
        <h4>Category</h4>
        <ul>
            @foreach(categoryh() as $categorie)
                <li>
                    <label>
                        <input type="checkbox" class="sort_rang category" id="category" name="category[]" value="{{ $categorie->id }}"> {{ $categorie->title ?? 'N/A' }}
                    </label>
                </li>
            @endforeach
        </ul>
    </div>
{{--    <div class="sidebar" style="height: 100px">--}}
{{--        <h4>Color: </h4>--}}
{{--        <ul>--}}
{{--            @foreach(colorh() as $color)--}}
{{--                <li style="float: left;">--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" class="sort_rang color" id="color" name="color[]" value="{{ $color->id }}" style="display: none;">--}}
{{--                        <span style="color:{{ $color->value }}; background-color:{{ $color->value }}; box-shadow: 1px 1px 5px black; border-radius: 100%;">⬤ </span>--}}
{{--                    </label>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--    <div class="sidebar">--}}
{{--        <h4>Size: </h4>--}}
{{--        <ul>--}}
{{--            @foreach(sizeh() as $size)--}}
{{--                <li>--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" class="sort_rang size" id="size" name="size[]" value="{{ $size->id }}"> {{ $size->name ?? 'N/A' }}--}}
{{--                    </label>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}

{{--    <div class="sidebar">--}}
{{--        <h4>Price: </h4>--}}
{{--        <ul>--}}
{{--            @foreach(brandh() as $brand)--}}
{{--                <li>--}}
{{--                    <label>--}}
{{--                        <input type="checkbox" class="sort_rang brand" id="brand" name="brand[]" value="{{ $brand->id }}"> {{ $brand->title ?? 'N/A' }}--}}
{{--                    </label>--}}
{{--                </li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}

    

    {{--                    <div class="sidebar">--}}
    {{--                        <h4>Size</h4>--}}
    {{--                        <ul>--}}
    {{--                            <li>--}}
    {{--                                <label>--}}
    {{--                                    <input type="checkbox" name="brand"> 42"--}}
    {{--                                </label>--}}
    {{--                            </li>--}}
    {{--                            <li>--}}
    {{--                                <label>--}}
    {{--                                    <input type="checkbox" name="brand"> 52"--}}
    {{--                                </label>--}}
    {{--                            </li>--}}
    {{--                            <li>--}}
    {{--                                <label>--}}
    {{--                                    <input type="checkbox" name="brand"> 56"--}}
    {{--                                </label>--}}
    {{--                            </li>--}}
    {{--                            <li>--}}
    {{--                                <label>--}}
    {{--                                    <input type="checkbox" name="brand"> 63"--}}
    {{--                                </label>--}}
    {{--                            </li>--}}

    {{--                        </ul>--}}
    {{--                    </div>--}}

</div>