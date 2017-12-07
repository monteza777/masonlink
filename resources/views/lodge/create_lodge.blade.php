@extends('layout.master')
@section('title','MasonLink | Create Lodge')
@section('activeReg','active')
@section('body')


<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.8/vue.js"></script>

<div class="col-md-12 col-lg-12 col-sm-12">
    <div class="well well-sm">
    <h3 class="text-center">Create Lodge</h3>
        <div class="container">
            <!-- <form class="form-group" action="/lodge" method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group col-md-3">
                <label for="rolename">Enter Lodge Name</label>
                <span class="redColor">*</span> 
                <input type="text" name="lodge_name" class="form-control" placeholder="Lodge Name" 
                value="{{Request::old('lodge_name')}}" required/> 
                </div>

                <div class="form-group col-md-3">
                <label for="Description">Enter Lodge Address</label>
                <span class="redColor">*</span> 
                <input type="text" name="lodge_address" class="form-control" placeholder="Lodge Address" 
                value="{{Request::old('lodge_address')}}" required />   
                </div>

                <div class="form-group col-md-3">
                <label for="Description">Enter Contact Number</label>
                <span class="redColor">*</span> 
                <input type="text" name="contact_number" class="form-control" placeholder="Contact Number" 
                value="{{Request::old('contact_number')}}" required /> <br>
                </div>

                <div class="form-group col-md-3">
                <label for="Description">Upload Logo</label>
                 <input type="file" name="image" class="form-control" id="images"><br>
                </div>

                <div class="pull-left">
                    <button class="btn btn-success" @click="addNewEmployeeForm">Add Member</button>
                    <button type="submit"  class="btn btn-primary">Register</button>
                </div>
            </form> -->
            <button class="btn btn-success" @click="addNewEmployeeForm">Add Member</button>

            <div class="col-md-12" >
            <div class="card mb-3" v-for="(employee, index) in employees">
            <div class="card-body"><br>
            <!-- <span class="float-left" style="cursor:pointer"> </span> -->
            <div class="employee-form">
              <div class="col-md-4"><input type="text" class="form-control" placeholder="Full Name"
                    v-model="employee.name"
              ></div>
              <div class="col-md-4"><input type="text" class="form-control" placeholder="Members Type"
                    v-model="employee.mtype"
              ></div>
              <div class="col-md-offset-3 pull-right"><button class="btn btn-danger btn-sm">X</button></div>
            </div>
            </div>
            </div>
            </div>

        </div><!--end of container -->
    </div><!-- end of col-md-12 -->
</div><!-- end of div well -->
@endsection

<script>
var app = new Vue({
    el: '.container',
    data: {
        employees: [
            {
                name: '',
                mtype: ''
            }
        ]
    },
    methods: {
        addNewEmployeeForm() {
            this.employees.push({
                name:'',
                mtype: ''
            })
        }
    }
})
</script>