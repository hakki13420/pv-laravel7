<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">المستخدمين</h3>
                <div v-if="errors" class="erors">
                    <ul>
                        <li v-for="error in errors" :key="error">
                            {{error}}
                        </li>
                    </ul>
                </div>
                <div class="card-tools d-flex">
                  <div class="input-group input-group-sm" style="width: 450px;">
                    <input type="text" @keyup.enter="searching" v-model="search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button  @click="searching" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                  </div>
                  <div class="input-group input-group-sm d-flex justify-content-end" style="width: 100px;">
                    <button @click="creating" class="bg-primary" data-toggle="modal" data-target="#CreateModal">
                      <i class="fas fa-plus-circle"></i>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table v-if="gate.isAdmin()||gate.isChef()" class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>الاسم و اللقب</th>
                      <th>البريد الاليكتروني</th>
                      <th>الصلاحيات</th>
                      <th>الفرقة</th>
                      <th>المصلحة</th>
                      <th>تاريخ التعديل</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(user,index) in users.data" :key="user.id">
                        <td>{{index+1}}</td>
                        <td>{{user.name}}</td>
                        <td>{{user.email}}</td>
                        <td>{{user.role}}</td>
                        <td>
                            <router-link :to="{name:'brigades', params:{brigade_id:user.brigade_id}}" class="small-box-footer nav-link">
                                {{user.brigade_id?user.brigade.libelle:"/"}}
                            </router-link>
                        </td>
                        <td>
                            <router-link :to="{name:'services', params:{service_id:user.service_id}}" class="small-box-footer nav-link">
                                {{user.service_id?user.service.service:"/"}}
                            </router-link>
                        </td>


                      <td>{{user.updated_at}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin()||gate.isChef()" class="dropdown-item"  href="" @click.prevent="edit(user)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(user.id)"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <pagination :data="users" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">editer user</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">Ajouter user</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="name">الاسم و اللقب</label>
                      <input v-if="errors.name" type="text" class="form-control is-invalid" v-model="name" placeholder="الاسم و اللقب">
                      <input v-else type="text" class="form-control" v-model="name" placeholder="الاسم و اللقب">
                      <span v-if="errors.name" class="text-danger">{{errors.name[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="email">البريد الاليكتروني</label>
                      <input v-if="errors.email" type="email" class="form-control is-invalid" v-model="email" placeholder="البريد الاليكتروني">
                      <input v-else type="email" class="form-control" v-model="email" placeholder="البريد الاليكتروني">
                      <span v-if="errors.email" class="text-danger">{{errors.email[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="password">كلمة المرور</label>
                      <input v-if="errors.password" type="password" class="form-control is-invalid" v-model="password" placeholder="كلمة المرور">
                      <input v-else type="password" class="form-control" v-model="password" placeholder="كلمة المرور">
                      <span v-if="errors.password" class="text-danger">{{errors.password[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="role">الدور</label>
                      <select v-if="errors.role" name="role" v-model="role" class="form-control is-invalid">
                        <option value="Admin">Admin</option>
                        <option value="Chef">Chef</option>
                        <option value="Agent">Agent</option>
                        <option value="Invite">Invite</option>
                      </select>
                      <select v-else name="role" v-model="role" class="form-control">
                        <option value="Admin">Admin</option>
                        <option value="Chef">Chef</option>
                        <option value="Agent">Agent</option>
                        <option value="Invite">Invite</option>
                      </select>
                      <span v-if="errors.role" class="text-danger">{{errors.role[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="grade_id">الرتبة</label>
                      <select v-if="errors.grade_id" name="grade_id" v-model="grade_id" class="form-control is-invalid">
                        <option v-for="grade in grades" :key="grade.id" v-bind:value="grade.id">{{grade.grade}}</option>
                      </select>
                      <select v-else name="grade_id" v-model="grade_id" class="form-control">
                        <option v-for="grade in grades" :key="grade.id" v-bind:value="grade.id">{{grade.grade}}</option>
                      </select>
                      <span v-if="errors.grade_id" class="text-danger">{{errors.grade_id[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="service_id">المصلحة</label>
                      <select v-if="errors.service_id" name="service_id" v-model="service_id" class="form-control is-invalid">
                        <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                      </select>
                      <select v-else name="service_id" v-model="service_id" class="form-control">
                        <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                      </select>
                      <span v-if="errors.service_id" class="text-danger">{{errors.service_id[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="brigade">الفرقة</label>
                      <select v-if="errors.brigade" name="brigade" v-model="brigade" class="form-control is-invalid">
                        <option :value="null">------------------</option>
                        <template v-for="brigade in brigades">
                            <option :key="brigade.id" v-bind:value="brigade.id">{{brigade.libelle}}-{{brigade.service.service}}</option>
                        </template>
                      </select>
                      <select v-else name="brigade" v-model="brigade" class="form-control">
                        <option :value="null">------------------</option>
                        <template v-for="brigade in brigades">
                            <option :key="brigade.id" v-bind:value="brigade.id">{{brigade.libelle}}-{{brigade.service.service}}</option>
                        </template>
                      </select>
                      <span v-if="errors.brigade" class="text-danger">{{errors.brigade[0]}}</span>
                    </div>

                    <div class="form-group">
                        <label for="carte_com">رقم بطاقة التفويض</label>
                        <input v-if="errors.carte_com" type="text" name="carte_com" v-model="carte_com" class="form-control is-invalid" placeholder="رقم بطاقة التفويض">
                        <input v-else type="text" name="carte_com" v-model="carte_com" class="form-control" placeholder="رقم بطاقة التفويض">
                        <span v-if="errors.carte_com" class="text-danger">{{errors.carte_com[0]}}</span>
                    </div>

                    <div class="form-group">
                        <label for="carte_com">تاريخ الصدور</label>
                        <input v-if="errors.date_carte_com" type="date" name="date_carte_com" v-model="date_carte_com" class="form-control is-invalid">
                        <input v-else type="date" name="date_carte_com" v-model="date_carte_com" class="form-control">
                        <span v-if="errors.date_carte_com" class="text-danger">{{errors.date_carte_com[0]}}</span>
                    </div>

                  <div class="card-footer">
                    <button v-if="is_edit && gate.isAdmin()" type="submit" @click.prevent="update" class="btn btn-primary">تعديل</button>
                    <button v-else-if="!is_edit && gate.isAdmin()" type="submit" @click.prevent="create" class="btn btn-primary">حفظ</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                  </div>
                </form>


            </div>

          </div>
        </div>
      </div>



    </div>
</template>

<script>
    export default {
        mounted() {
            //console.log('Component mounted.');
            //this.index();
            if(this.$route.params.user_id!=undefined){
                axios.get('userById/'+this.$route.params.user_id)
                .then( response => {
                    this.users = response.data.users;
                    this.services = response.data.services;
                    this.brigades = response.data.brigades;
                    this.grades = response.data.grades;
                });
            }else{
                this.getResults();
            }
        },
        props:[],
        watch:{


        },
        data(){
            return {
                'name':'',
                'email':'',
                'password':'',
                'role':'',
                'service_id':'',
                'brigade':'',
                'grade_id':'',
                'carte_com':'',
                'date_carte_com':'',
                'id_update':'',
                users:{},
                services: {},
                brigades: {},
                grades: {},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                this.$Progress.start()
                axios.get('users?page=' + page)
                .then(response => {
                    this.users = response.data.users;
                    this.services = response.data.services;
                    this.brigades = response.data.brigades;
                    this.grades = response.data.grades;

                    this.$Progress.finish();
                })
                .catch((error)=>{
                    this.errors=error.response.data.errors;
                    this.$Progress.fail();
                });
            },
            remove:function(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            this.$Progress.start()
                            axios.delete('users/'+id)
                            .then((response)=>{
                                this.index()
                                this.$Progress.finish()

                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )

                            })
                            .catch((error)=>{
                                console.log(error);
                                this.errors=error.response.data.errors;
                                this.$Progress.fail()

                                Swal.fire(
                                'not Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                            });
                        }
                    })
             },
            edit:function(user){
                this.errors=[];
                this.is_edit=true;
                this.name=user.name;
                this.email=user.email;
                this.password=user.password;
                this.role=user.role;
                this.grade_id=user.grade_id;
                this.carte_com=user.carte_com;
                this.date_carte_com=user.date_carte_com;
                this.service_id=user.service_id;
                this.brigade=user.brigade_id;

                this.id_update=user.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.name='';
                this.email='';
                this.password='';
                this.role='';
                this.grade_id='';
                this.service_id='';
                this.brigade='';
                this.carte_com='';
                this.date_carte_com='';

            },
            update:function(){
                this.$Progress.start()
                axios.put('users/'+this.id_update,
              {'name':this.name, 'email':this.email, 'password':this.password, 'role':this.role,'grade_id':this.grade_id,
              'service':this.service_id,'brigade':this.brigade,'carte_com':this.carte_com,'date_carte_com':this.date_carte_com})
                .then((response)=> {
                    //this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    this.index();
                    this.showMessage("updated successfully","success");
                    // this.name='';
                    // this.email='';
                    // this.password='';
                    // this.role='';
                    // this.grade='';
                    // this.service_id='';
                    // this.brigade='';
                    this.$Progress.finish()
                })
                .catch((error)=> {
                    this.errors=error.response.data.errors
                    this.$Progress.fail()
                });

            },
            index:function(){
                this.$Progress.start();
                axios.get('users')
                .then((response) => {
                        //console.log(response.data.data);
                        this.users=response.data.users
                        this.services=response.data.services
                        this.brigades=response.data.brigades
                        this.grades=response.data.grades
                        //console.log('index');
                        //console.log(this.users);
                        this.$Progress.finish();
                })
                .catch((error)=> {
                    this.errors=error.response.data.errors;
                    this.$Progress.fail();
                });
            },
            create:function(){
              this.$Progress.start()
              axios.post('users',
              {'name':this.name, 'email':this.email, 'password':this.password, 'role':this.role, 'grade_id':this.grade_id,
                'service':this.service_id,'brigade':this.brigade,'carte_com':this.carte_com, 'date_carte_com':this.date_carte_com})
              .then((response)=>{
                    $('#CreateModal').modal('hide');
                    this.index();
                    this.showMessage("created successfully","success");
                    this.$Progress.finish()
              })
              .catch((error)=>{
                  this.errors=error.response.data.errors
                  this.$Progress.fail()
              });
            //   this.name='';
            //   this.email='';
            //   this.password='';
            //   this.role='';
            //   this.service_id='';
            //   this.brigade='';
            //   this.grade_id='';
            //   this.carte_com='';
            //   this.date_carte_com='';

            },
            getUserById(id) {
                axios.get('admin.user/' +id)
                .then(response => {
                    //console.log(response.data.data);
                    this.users = response.data.users;
                    this.services = response.data.services;
                    this.brigades = response.data.brigades;
                    this.grades = response.data.grades;
                });
            },
            searching:function(){
                //this.$Progress.start();
                if(!this.search){
                    this.index()
                }else{
                    axios.get('users/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                        this.users=response.data.users;
                        //console.log(response);
                        //this.$Progress.finish();
                    })
                }
            },
            showMessage:function(message,type){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: type,
                    title: message
                    })
            },
        }
    }
</script>
