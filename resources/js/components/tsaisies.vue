<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">الحجوزات</h3>
                <div class="card-tools d-flex">
                  <div class="input-group input-group-sm" style="width: 450px;">
                    <input type="text" @keyup.enter="searching" v-model="search" class="form-control float-right" placeholder="بحث">

                    <div class="input-group-append">
                      <button  @click="searching" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                  </div>
                  <div class="input-group input-group-sm d-flex justify-content-end" style="width: 100px;">

                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>رقم الحجز</th>
                      <th>نوع الحجز</th>
                      <th>المحضر</th>
                      <th>طبيعة المحجوزات</th>
                      <th>تاريخ الحجز</th>
                      <th>مكان الحجز</th>
                      <th>ايداع الحجز</th>
                      <th>الكمية</th>
                      <th>القيمة</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(tsaisie,index) in tsaisies.data" :key="tsaisie.id">
                      <td>{{index+1}}</td>
                      <td>{{tsaisie.num_saisie}}</td>
                      <td>{{tsaisie.typesaisie.libelle}}</td>
                      <td>{{tsaisie.pv_id}}</td>
                      <td>{{tsaisie.category.category}}</td>
                      <td>{{tsaisie.date_saisie}}</td>
                      <td>{{tsaisie.lieux_saisie}}</td>
                      <td>{{tsaisie.depot_saisie}}</td>
                      <td>{{tsaisie.quantite}}</td>
                      <td>{{tsaisie.somme_Da}}</td>



                      <td>{{tsaisie.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(tsaisie)"><i class="fa fa-edit"></i></a>
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

        <pagination :data="tsaisies" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">حجز</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                      <label for="num_saisie">رقم الحجز</label>
                      <input v-if="errors.num_saisie" type="text" class="form-control is-invalid" v-model="num_saisie" placeholder="رقم الحجز">
                      <input v-else type="text" class="form-control" v-model="num_saisie" placeholder="رقم الحجز">
                      <span v-if="errors.num_saisie" class="text-danger">{{errors.num_saisie[0]}}</span>
                    </div>


                    <div class="form-group">
                        <label for="typesaisie_id"> نوع الحجز</label>
                        <select v-if="errors.typesaisie_id" name="typesaisie_id" v-model="typesaisie_id" class="form-control is-invalid">
                            <option v-for="type_saisie in type_saisies" :key="type_saisie.id" v-bind:value="type_saisie.id">{{type_saisie.libelle}}</option>
                        </select>
                        <select v-else name="typesaisie_id" v-model="typesaisie_id" class="form-control">
                            <option v-for="type_saisie in type_saisies" :key="type_saisie.id" v-bind:value="type_saisie.id">{{type_saisie.libelle}}</option>
                        </select>
                        <span v-if="errors.typesaisie_id" class="text-danger">{{errors.typesaisie_id[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="pv_id">المحضر</label>
                      <input v-if="errors.pv_id" type="email" class="form-control is-invalid" v-model="pv_id" placeholder="المحضر">
                      <input v-else type="text" class="form-control" v-model="pv_id" placeholder="المحضر">
                      <span v-if="errors.pv_id" class="text-danger">{{errors.pv_id[0]}}</span>
                    </div>

                     <div class="form-group">
                        <label for="category_id"> طبيعة المحجوزات</label>
                        <select v-if="errors.category_id" name="category_id" v-model="category_id" class="form-control is-invalid">
                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.category}}</option>
                        </select>
                        <select v-else name="category_id" v-model="category_id" class="form-control">
                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.category}}</option>
                        </select>
                        <span v-if="errors.category_id" class="text-danger">{{errors.category_id[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="date_saisie">تاريخ الحجز</label>
                      <input v-if="errors.date_saisie" type="date" class="form-control is-invalid" v-model="date_saisie" placeholder="تاريخ الحجز">
                      <input v-else type="date" class="form-control" v-model="date_saisie" placeholder="تاريخ الحجز">
                      <span v-if="errors.date_saisie" class="text-danger">{{errors.date_saisie[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="lieux_saisie">مكان الحجز</label>
                      <input v-if="errors.lieux_saisie" type="email" class="form-control is-invalid" v-model="lieux_saisie" placeholder="مكان الحجز">
                      <input v-else type="text" class="form-control" v-model="lieux_saisie" placeholder="مكان الحجز">
                      <span v-if="errors.lieux_saisie" class="text-danger">{{errors.lieux_saisie[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="depot_saisie">الايداع</label>
                      <input v-if="errors.depot_saisie" type="email" class="form-control is-invalid" v-model="depot_saisie" placeholder="الايداع">
                      <input v-else type="text" class="form-control" v-model="depot_saisie" placeholder="الايداع">
                      <span v-if="errors.depot_saisie" class="text-danger">{{errors.depot_saisie[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="quantite">الكمية</label>
                      <input v-if="errors.quantite" type="email" class="form-control is-invalid" v-model="quantite" placeholder="الكمية">
                      <input v-else type="text" class="form-control" v-model="quantite" placeholder="الكمية">
                      <span v-if="errors.quantite" class="text-danger">{{errors.quantite[0]}}</span>
                    </div>


                    <div class="form-group">
                      <label for="sommeDa">القيمة</label>
                      <input v-if="errors.sommeDa" type="email" class="form-control is-invalid" v-model="sommeDa" placeholder="القيمة">
                      <input v-else type="text" class="form-control" v-model="sommeDa" placeholder="القيمة">
                      <span v-if="errors.sommeDa" class="text-danger">{{errors.sommeDa[0]}}</span>
                    </div>

                  <div class="card-footer">
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
            this.getResults();


        },
        props:[],
        watch:{

        },
        data(){
            return {
                'num_saisie':'',
                'typesaisie_id':'',
                'pv_id':'',
                'category_id':'',
                'lieux_saisie':'',
                'date_saisie':'',
                'depot_saisie':'',
                'quantite':'',
                'sommeDa':'',
                'created_by':'',
                'id_update':'',
                tsaisies:{},
                type_saisies:{},
                categories:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('tsaisies?page=' + page)
                .then(response => {
                    this.tsaisies = response.data.tsaisies;
                    this.type_saisies = response.data.type_saisies;
                    this.categories = response.data.categories;
                });
            },
            remove:function(id){

            },
            edit:function(tsaisie){
                this.errors=[];
                this.is_edit=true;
                this.num_saisie=tsaisie.num_saisie;
                this.typesaisie_id=tsaisie.typesaisie_id;
                this.category_id=tsaisie.category_id;
                this.pv_id=tsaisie.pv_id;
                this.date_saisie=tsaisie.date_saisie;
                this.lieux_saisie=tsaisie.lieux_saisie;
                this.depot_saisie=tsaisie.depot_saisie;
                this.quantite=tsaisie.quantite;
                this.sommeDa=tsaisie.sommeDa;
                this.id_update=tsaisie.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){

            },
            initialize:function(){

            },
            update:function(){

            },
            index:function(){
                axios.get('tsaisies')
                .then((resource) =>{
                    this.tsaisies = response.data.tsaisies;
                    this.type_saisies = response.data.type_saisies;
                    this.categories = response.data.categories;
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('saisies/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                        this.commercants=response.data
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
