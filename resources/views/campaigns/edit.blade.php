@extends('layouts.app')
@include('layouts.nav')

<div class="container-fluid">
    <div class="row">
        @include('layouts.header')

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="border-bottom mb-3 pt-3 pb-2">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center">
                    <h1 class="h2">{{$campaign->name}}</h1>
                </div>
            </div>

            <form class="needs-validation" novalidate action="{{route('campaign.update',$campaign->id)}}" method="post">
                @csrf
                @method('patch')
                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputName">Name</label>
                        <!-- adding the class is-invalid to the input, shows the invalid feedback below -->
                        <input type="text" class="form-control {{$errors->first('name') ? 'is-invalid' : ''}}"
                               id="inputName" name="name" placeholder=""
                               value="{{old('name') ? old('name') : $campaign->name}}">
                        <div class="invalid-feedback">
                            {{$errors->first('name') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputSlug">Slug</label>
                        <input type="text" class="form-control  {{$errors->first('slug') ? 'is-invalid' : ''}}"
                               id="inputSlug" name="slug" placeholder=""
                               value="{{old('slug') ? old('slug') : $campaign->slug}}">
                        <div class="invalid-feedback">
                            {{$errors->first('slug') }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-lg-4 mb-3">
                        <label for="inputDate">Date</label>
                        <input type="text"
                               class="form-control  {{$errors->first('date') ? 'is-invalid' : ''}}"
                               id="inputDate"
                               name="date"
                               placeholder="yyyy-mm-dd"
                               value="{{old('date') ? old('date') : $campaign->date}}">
                        <div class="invalid-feedback">
                            {{$errors->first('date') }}
                        </div>
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-primary" type="submit">Save campaign</button>
                <a href="{{route('campaign.show',$campaign->id)}}" class="btn btn-link">Cancel</a>
            </form>

        </main>
    </div>
</div>

</body>
</html>
