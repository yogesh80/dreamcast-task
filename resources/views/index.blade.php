@extends('layout')

@section('content')
@section('title', 'Dream cast task')
<section class="login mt-5" style="display: none" id="add-user-form">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-7 mx-auto ">
                <div class="login-outer form-design">
                    <div class="text-center pb-3">
                        <img src="https://godreamcast-content.s3.ap-south-1.amazonaws.com/images/logo-sticky.png"
                            width="100px" alt="logo">
                        <h1 class="login-heading">@lang('Create new account')</h1>
                        <p class="para">@lang('Provide your details')
                        </p>
                        <div id="errorContainer" class="hel" style="display: none;"></div>

                    </div>
                    <form enctype="multipart/form-data" id="addUserForm" autocomplete="off">
                        @csrf
                        <div class="form-group">
                            <label for="country">{{ trans('User Role') }}</label>
                            <select class="form-control " name="role_id" required>
                                <option readonly disabled>@lang('Select Role')</option>
                                @foreach ($roles as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="store_name">{{ trans('Name') }}</label>
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">{{ trans('Email') }}</label>
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ old('email') }}" autocomplete="new-email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">{{ trans('Phone') }}</label>
                            <input type="tel" name="phone" class="form-control" id="phone"
                                value="{{ old('phone') }}" autocomplete="off" required>
                            <span for="phone" id="output"></span>
                        </div>
                        <div class="form-group">
                            <label for="profile_image">{{ trans('Profile Image') }} @lang('(optional)')</label>
                            <input type="file" name="profile_image" class="form-control" id="profile_image"
                                value="{{ old('profile_image') }}">
                        </div>
                        <div>
                            <label for="description">{{ trans('Description') }}</label>
                            <textarea name="description" rows="4" cols="50" class="form-control" id="description" required></textarea>
                        </div>

                        <button type="submit"
                            class="btn w-100 glow-on-hover submit-btn">{{ trans('Create') }}</button>
                    </form>
                </div>

            </div>
        </div>

    
    </div>
</section>

<section class="mt-5" id="users-tabel-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-lg-12">
                <button class="btn-sm btn-primary mb-3 text-white" id="add-user-btn"> Create User</button>

                <table class="table table-bordered" id="usersTable">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Role</th>
                            <th scope="col">Description</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</section>




@endsection
