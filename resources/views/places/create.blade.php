@extends('layouts.app')
@extends('layouts.nav')

<div class="container-fluid">
    <div class="row">
        @include('layouts.header')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$campaign->name}}}</h1>
                </div>
                <span class="h6">{{date('F d, Y',strtotime($campaign->date))}}</span>
            </div>

            <div class="mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h2 class="h4">Create new Place</h2>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{route('place.store',$campaign->id)}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
                               id="inputName" name="name" placeholder=""
                               value="{{old('name')}}">
                        <div class="invalid-feedback">
                            {{$errors->first('name') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="selectChannel">Area</label>
                        <select class="form-control" id="selectChannel" name="area_id">
                            @foreach($campaign->area as $area)
                                <option value="{{$area->id}}">{{$area->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputCapacity">Capacity</label>
                        <input type="number" class="form-control {{$errors->first('capacity') ? 'is-invalid' : ''}}"
                               id="inputCapacity" name="capacity" placeholder=""
                               value="{{old('capacity')}}">
                        <div class="invalid-feedback">
                            {{$errors->first('capacity') }}
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save place</button>
                <a href="{{route('campaign.show',$campaign->id)}}" class="btn btn-link">Cancel</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
