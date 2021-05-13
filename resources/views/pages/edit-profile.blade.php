@extends('layouts.app')

@section('content')
    <div class="page-margin background-light">
        @php
          if (isset($user->image))
            $image_path = 'storage/'.$user->image;
          else
            $image_path = 'images/profile.png';
        @endphp

        <form method="post" action="{{route('edit-profile')}}" data-toggle="validator" autocomplete="off"
              enctype="multipart/form-data">
            @method('put')
            {{ csrf_field() }}
            <section id="profile-main" class="card grid-profile container-lg">
                <div class="one mr-4">
                    <!-- Nickname and Photo -->
                    <h3 class="nickname mb-4 text-center">{{$user->username}}</h3>
                    <div class="profile-pic col-md mb-4 text-center">
                        <img class="bd-placeholder-img img-thumbnail rounded-circle mb-3" id="register-image"
                             src="{{asset($image_path)}}" alt="profile image">
                    </div>

                    <div class="mb-4">
                        <input type="file" id="register-file" class="form-control-file" name="profile-image">
                        <label for="register-file" class="custom-file-upload btn-link text-center">
                            <i class="fa fa-upload"></i> Profile picture
                        </label>
                        <span id="profile-image-error" class="error">
                        @if ($errors->has('profile-image'))
                                {{ $errors->first('profile-image') }}
                            @endif
                    </span>
                    </div>
                </div>

                <div class="form-edit-profile">


                    <div class="two row">
                        <section class="profile-info col-md mb-4">
                            <h3>Personal</h3>
                            <!-- Name -->
                            <label class="form-label d-block ">Name</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Name">
                                    <span class="input-group-text"><i class="fas fa-user edit-icon"></i></span>
                                </div>
                                <input type="text" class="form-control" name="name" value="{{$user->name}}">
                            </div>
                            <!-- Email -->
                            <label class="form-label">Email*</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Email">
                                    <span class="input-group-text"><i class="fas fa-at edit-icon"></i></span>
                                </div>
                                <input type="text" class="form-control" name="email" value="{{$user->email}}" required>
                            </div>

                            <!-- Birthday -->
                            <label class="form-label">Birthday</label>
                            <div class="input-group">
                                <div class="input-group-prepend" title="Birthday">
                                    <span class="input-group-text"><i class="fa fa-calendar edit-icon"
                                                                      aria-hidden="true"></i></span>
                                </div>
                                <input class="form-control" type="date" name="birthday" value="{{$user->birthday}}">
                            </div>
                        </section>

                        <!-- About me -->
                        <section class="profile-about-me col-md mb-4">
                            <h3>About Me</h3>
                            <div class="mb-3">
                                <textarea class="form-control about-me"
                                          name="description">{{$user->description}}</textarea>
                                <div id="questionBodyHelp" class="form-text">Describe all the details about you!</div>
                            </div>
                        </section>

                    </div>
                    <section class="three profile-academic-info">
                        <h3>Academic Information</h3>
                        <!-- Course -->
                        <div class="mb-3">
                            <label for="questionCourseSelect" class="form-label">Course</label>
                            <select id="questionCourseSelect" name="course" class="form-select">
                                <option>None</option>
                                @foreach($courses as $course)
                                    @if(isset($user->course) && $course->name == $user->course->name)
                                        <option selected>{{$course->name}}</option>
                                    @else
                                        <option>{{$course->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        <!-- Tags -->
                    @include("partials.add-question.tags")

                    <!-- Toast -->
                        @include("partials.common.toast")

                    </section>

                    <div class="d-md-flex">
                        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
                        <button type="submit" class="btn btn-outline-primary mx-2 mt-3">Cancel</button>
                        <button type="submit" class="btn btn-outline-danger mt-3 ms-md-auto">Delete Account</button>
                    </div>

                </div>

            </section>
        </form>
    </div>


    <script>const tags = @json($tags);</script>
    <script> const oldTagsList = @json($user->tags); </script>
@endsection
