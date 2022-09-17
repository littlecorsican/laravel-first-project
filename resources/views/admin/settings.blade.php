@extends('layout')
 
@section('title', 'Admin Settings')
 
<!-- @section('sidebar')
 
    <p>This is appended to the master sidebar.</p>
@stop -->
 
@section('content')


    <div>
        <div>
            <h1>Add venue type</h1>
            @if (Session::has('addVenueTypeMsg'))
                <div class="alert alert-info">{{ Session::get('addVenueTypeMsg') }}</div>
            @endif
            <table class="table" >
                <thead class="thead-dark">
                    <tr><th>Venue type</th><th>Delete</th></tr>
                </thead>
                <tbody>
                @foreach ($venue_type as $item)
                    <tr><td>{{$item->venue_type_name}}</td><td><button id="" class="btn btn-primary" onClick="deleteVenueType(this, {{$item->id}})">Delete</button></td></tr>
                @endforeach
                </tbody>
            </table>
            <h4>Add Venue Type</h4>
            <form action="/venuetype/create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="venue_type_name"></label>
                    <input type="text" class="form-control" name="venue_type_name" id="venue_type_name" placeholder="Venue Type">
                </div>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
        <br/>
        <br/>
        <br/>
        <div>
            <h1>Add venues</h1>
            @if (Session::has('addVenueMsg'))
                <div class="alert alert-info">{{ Session::get('addVenueMsg') }}</div>
            @endif
            <table class="table" >
                <thead class="thead-dark">
                    <tr><th>Venue Id</th><th>Court ID</th><th>Venue type</th><th>Price per hour</th><th>Start Hour</th><th>End Hour</th><th>Rest days</th><th>Delete</th></tr>
                </thead>
                <tbody>
                @foreach ($venues as $item)
                
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->court_id}}</td>
                        <td>{{$item->venue_type_name}}</td>
                        <td>{{$item->venue_price}}</td>
                        <td>{{$item->start_hour}}:00</td>
                        <td>{{$item->end_hour}}:00</td>
                        <td>@foreach(explode(',', $item->rest_days) as $off_day) 
                            <span>{{$days[$off_day]}}  </span>
                        @endforeach</td>
                        <td><button id="" class="btn btn-primary" onClick="deleteVenue(this, {{$item->id}})">Delete</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <h4>Add Venue and Price</h4>
            <form action="/venue/create" method="POST">
                @csrf
                <div class="form-group">
                    <select class="form-select" name="venues" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @for ($i = 0; $i < COUNT($venue_type) ; $i++)
                            <option value='{{$venue_type[$i]->id}}'>{{$venue_type[$i]->venue_type_name}}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label for="court_id">Court Id</label>
                    <input type="number" class="form-control" name="court_id" id="court_id" placeholder="Court ID">
                </div>
                <br/>
                <div class="form-group">
                    <label for="venue_price">Price per hour</label>
                    <input type="text" class="form-control" name="venue_price" id="venue_price" placeholder="Price per hour">
                </div>
                <div>
                    <label for="rest_days">Rest days</label><br/>
                        @for ($i = 1; $i < 8 ; $i++)
                            <input type="checkbox" name="rest_days_{{$i}}" />&nbsp;<label>{{$days[$i]}}</label><br/>
                        @endfor
                    <checkbox>
                </div>
                <br/>
                <div>
                    <label for="hours">Operating Hours</label><br/>
                    Start : <select class="form-select" name="start_hour" aria-label="Default select example">
                        @for ($i = 0; $i < 24 ; $i++)
                            <option value='{{$i}}'>{{$i}}:00</option>
                        @endfor
                    </select> 
                    - 
                    End : <select class="form-select" name="end_hour" aria-label="Default select example">
                        @for ($i = 1; $i < 25 ; $i++)
                            <option value='{{$i}}'>{{$i}}:00</option>
                        @endfor
                    </select> 
                </div>
                <br/>
                <button type="submit" class="btn btn-primary">Add</button>
            </form>

        </div>
        <br/>
        <br/>
        <br/>
        <div>
            <h1>Provide admin priviledge to user</h1>
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="searchedUser" name="username" placeholder="Username" value="cyxstudio">
            </div>
            <button class="btn btn-primary" id="searchUser">Search User</button>
            <div id="status_text"></div>
            <div>
                <div style="border-radius:4px;background-color:#bdb0af;padding:8px 12px;margin:16px 0px">
                    <p>No priviledge - Normal user, can only book</p>
                    <p>Admin level 1 - Limited admin, can only view bookings  </p> 
                    <p>Admin level 2 - Super admin, can edit everything</p>
                </div>
                <h4>Result</h4>
                <table class="table" id="userTable">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Priviledge Level</th>
                        <th scope="col">Elevate to Admin level 1</th>
                        <th scope="col">Elevate to Admin level 2</th>
                        <th scope="col">Remove all priviledge</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br/>
        <br/>
        <br/>
        <!-- <div>
            <h1>Add off days/hours</h1>

        </div> -->
    </div>
    <script>
        $( document ).ready(function() {
            console.log( "ready!" );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            

            $("#searchUser").click(function(){

                let username = $("#searchedUser").val();

                $("#searchedUser").prop('disabled', true);
                $("#searchUser").prop('disabled', true);
                $("#status_text").text('Loading...');

                $.ajax({
                    type:'POST',
                    url:"/admin/searchuser",
                    data:{username:username},
                    success:function(data){
                        console.log(data)
                        let tableData = ''
                        if (data == "" ) {
                            tableData = `<tr><td> No such user found </td></tr>`
                        } else {
                            tableData = `
                                <tr>
                                    <td>${data.username[0].username}</td>
                                    <td>${data.email[0].email}</td>
                                    <td>${data.priviledge[0].priviledge}</td>
                                    <td><button id="btnPriv1" class="btn btn-primary" onClick="btnPriv1('${data.username[0].username}')">Submit</button></td>
                                    <td><button id="btnPriv2" class="btn btn-primary" onClick="btnPriv2('${data.username[0].username}')">Submit</button></td>
                                    <td><button id="btnPriv3" class="btn btn-primary" onClick="btnPriv3('${data.username[0].username}')">Submit</button></td>
                                </tr>
                            `
                        }
                        $('#userTable > tbody').html('');
                        $('#userTable > tbody:last-child').append(tableData);
                    },
                    fail:function(data) {
                        alert("Failed, something went wrong.")
                    },
                    complete:function(){
                        $("#searchedUser").prop('disabled', false);
                        $("#searchUser").prop('disabled', false);
                        $("#status_text").text('Search completed');
                    }
                });
            })
        });

        function btnPriv1(username) {
            $("#btnPriv1").prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"/admin/setpriviledgelevel",
                data:{username:username, priviledge:"1"},
                success:function(data){
                    console.log(data)
                    alert("Succesfully altered priviledge level")
                },
                fail:function(data) {
                    alert("Failed, something went wrong.")
                },
                complete:function(){
                    $("#btnPriv1").prop('disabled', false);
                }
            })
        }

        function btnPriv2(username) {
            $("#btnPriv2").prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"/admin/setpriviledgelevel",
                data:{username:username, priviledge:"2"},
                success:function(data){
                    console.log(data)
                    alert("Succesfully altered priviledge level")
                },
                fail:function(data) {
                    alert("Failed, something went wrong.")
                },
                complete:function(){
                    $("#btnPriv2").prop('disabled', false);
                }
            })
        }

        function btnPriv3(username) {
            $("#btnPriv3").prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"/admin/setpriviledgelevel",
                data:{username:username, priviledge:"0"},
                success:function(data){
                    console.log(data)
                    alert("Succesfully altered priviledge level")
                },
                fail:function(data) {
                    alert("Failed, something went wrong.")
                },
                complete:function(){
                    $("#btnPriv2").prop('disabled', false);
                }
            })
        }

        function deleteVenue(ele, id) {
            $(ele).prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"/venue/remove",
                data:{id:id},
                success:function(data){
                    console.log(data)
                    alert("Succesfully removed item")
                    location.reload();
                },
                fail:function(data) {
                    alert("Failed, something went wrong.")
                },
                complete:function(){
                    $(ele).prop('disabled', false);
                }
            })
        }

        function deleteVenueType(ele, id) {
            $(ele).prop('disabled', true);
            $.ajax({
                type:'POST',
                url:"/venuetype/remove",
                data:{id:id},
                success:function(data){
                    console.log(data)
                    alert("Succesfully removed item")
                    location.reload();
                },
                fail:function(data) {
                    alert("Failed, something went wrong.")
                },
                complete:function(){
                    $(ele).prop('disabled', false);
                }
            })
        }

    </script>

@stop