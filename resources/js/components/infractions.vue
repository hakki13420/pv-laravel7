<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">المخالفات</h3>
                        <div class="card-tools d-flex">
                            <div
                                class="input-group input-group-sm"
                                style="width: 450px;"
                            >
                                <input
                                    type="text"
                                    @keyup.enter="searching"
                                    v-model="search"
                                    class="form-control float-right"
                                    placeholder="بحث"
                                />

                                <div class="input-group-append">
                                    <button
                                        @click="searching"
                                        class="btn btn-default"
                                    >
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div
                                class="input-group input-group-sm d-flex justify-content-end"
                                style="width: 100px;"
                            >
                                <button
                                    @click="creating"
                                    class="bg-primary"
                                    data-toggle="modal"
                                    data-target="#CreateModal"
                                >
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table
                            v-if="
                                gate.isAdmin() ||
                                    gate.isChef() ||
                                    gate.isAgent()
                            "
                            class="table table-hover text-wrap"
                        >
                            <thead>
                                <tr>
                                    <th>الرقم</th>
                                    <th>المخالفة</th>
                                    <th>الفانون</th>
                                    <th>المواد</th>
                                    <th>القانون المعاقب</th>
                                    <th>المواد المعاقبة</th>

                                    <th>أضيفت من طرف</th>
                                    <th>الخيارات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(infraction,
                                    index) in infractions.data"
                                    :key="infraction.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <td>{{ infraction.libelle }}</td>
                                    <td>{{ infraction.lois }}</td>
                                    <td>{{ infraction.articles }}</td>
                                    <td>{{ infraction.lois_p }}</td>
                                    <td>{{ infraction.articles_p }}</td>

                                    <td>{{ infraction.created_by }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button
                                                class="btn btn-secondary dropdown-toggle"
                                                type="button"
                                                data-toggle="dropdown"
                                            >
                                                <i class="fas fa-bars"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <router-link
                                                    :to="{
                                                        name: 'model_redaction',
                                                        params: {
                                                            infraction_id:
                                                                infraction.id
                                                        }
                                                    }"
                                                    class="small-box-footer nav-link"
                                                >
                                                    نماذج
                                                </router-link>
                                                <a
                                                    v-if="
                                                        gate.isAdmin() ||
                                                            gate.isChef() ||
                                                            gate.isAgent()
                                                    "
                                                    class="dropdown-item"
                                                    href=""
                                                    @click.prevent="
                                                        edit(infraction)
                                                    "
                                                    ><i class="fa fa-edit"></i
                                                ></a>
                                                <a
                                                    v-if="gate.isAdmin()"
                                                    class="dropdown-item"
                                                    href=""
                                                    @click.prevent="
                                                        remove(infraction.id)
                                                    "
                                                    ><i class="fa fa-trash"></i
                                                ></a>
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

        <pagination
            :data="infractions"
            @pagination-change-page="getResults"
        ></pagination>

        <!-- Modal -->
        <div
            class="modal fade"
            id="CreateModal"
            tabindex="-1"
            aria-labelledby="exampleModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5
                            v-if="is_edit"
                            class="modal-title"
                            id="exampleModalLabel"
                        >
                            تعديل مخالفة
                        </h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">
                            إضافة مخالفة
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="code">رمز المخالفة</label>
                                <input
                                    v-if="errors.code"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="code"
                                    placeholder="رمز المخالفة"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="code"
                                    placeholder="رمز المخالفة"
                                />
                                <span v-if="errors.code" class="text-danger">{{
                                    errors.code[0]
                                }}</span>
                            </div>
                            <div class="form-group">
                                <label for="libelle">تسمية المخالفة</label>
                                <input
                                    v-if="errors.libelle"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="libelle"
                                    placeholder="التسمية"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="libelle"
                                    placeholder="التسمية"
                                />
                                <span
                                    v-if="errors.libelle"
                                    class="text-danger"
                                    >{{ errors.libelle[0] }}</span
                                >
                            </div>
                            <div class="form-group">
                                <label for="libelle_fr">تسمية المخالفة</label>
                                <input
                                    v-if="errors.libelle_fr"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="libelle_fr"
                                    placeholder="التسمية"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="libelle_fr"
                                    placeholder="التسمية"
                                />
                                <span
                                    v-if="errors.libelle_fr"
                                    class="text-danger"
                                    >{{ errors.libelle_fr[0] }}</span
                                >
                            </div>
                            <div class="form-group">
                                <label for="lois">القانون</label>
                                <input
                                    v-if="errors.lois"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="lois"
                                    placeholder="التسمية المختصرة"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="lois"
                                    placeholder="القانون"
                                />
                                <span v-if="errors.lois" class="text-danger">{{
                                    errors.lois[0]
                                }}</span>
                            </div>

                            <div class="form-group">
                                <label for="articles">المواد</label>
                                <input
                                    v-if="errors.articles"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="articles"
                                    placeholder="المواد"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="articles"
                                    placeholder="المواد"
                                />
                                <span
                                    v-if="errors.articles"
                                    class="text-danger"
                                    >{{ errors.articles[0] }}</span
                                >
                            </div>

                            <div class="form-group">
                                <label for="lois_p">القانون المعاقب</label>
                                <input
                                    v-if="errors.lois_p"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="lois_p"
                                    placeholder="القانون المعاقب"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="lois_p"
                                    placeholder="القانون المعاقب"
                                />
                                <span
                                    v-if="errors.lois_p"
                                    class="text-danger"
                                    >{{ errors.lois_p[0] }}</span
                                >
                            </div>

                            <div class="form-group">
                                <label for="articles_p">المواد المعاقبة</label>
                                <input
                                    v-if="errors.articles_p"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="articles_p"
                                    placeholder="المواد المعاقبة"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="articles_p"
                                    placeholder="المواد المعاقبة"
                                />
                                <span
                                    v-if="errors.articles_p"
                                    class="text-danger"
                                    >{{ errors.articles_p[0] }}</span
                                >
                            </div>

                            <div class="form-group">
                                <label for="amande">الغرامة</label>
                                <input
                                    v-if="errors.amande"
                                    type="text"
                                    class="form-control is-invalid"
                                    v-model="amande"
                                    placeholder="الغرامة"
                                />
                                <input
                                    v-else
                                    type="text"
                                    class="form-control"
                                    v-model="amande"
                                    placeholder="الغرامة"
                                />
                                <span
                                    v-if="errors.amande"
                                    class="text-danger"
                                    >{{ errors.amande[0] }}</span
                                >
                            </div>

                            <div class="card-footer">
                                <button
                                    v-if="is_edit"
                                    type="submit"
                                    @click.prevent="update"
                                    class="btn btn-primary"
                                >
                                    تعديل
                                </button>
                                <button
                                    v-else
                                    type="submit"
                                    @click.prevent="create"
                                    class="btn btn-primary"
                                >
                                    حفظ
                                </button>
                                <button
                                    type="button"
                                    class="btn btn-secondary"
                                    data-dismiss="modal"
                                >
                                    غلق
                                </button>
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
        this.getResults();
    },
    created() {
        //console.log('Component mounted.');
        //this.index();
        //this.id=this.$route.params.id;;
    },
    props: [],
    watch: {},
    data() {
        return {
            code: "",
            libelle: "",
            libelle_fr: "",
            lois: "",
            articles: "",
            lois_p: "",
            articles_p: "",
            amande: "",
            resultat_id: "",
            id_update: "",
            infractions: {},
            corps: {},
            resultats: {},
            errors: [],
            is_edit: false,
            search: ""
        };
    },
    methods: {
        getResults(page = 1) {
            axios.get("infractions?page=" + page).then(response => {
                // console.log(response);
                this.infractions = response.data.infractions;

                // this.resultats = response.data.resultats;
                // this.nbInfractionsRf = response.data.nbInfractionsRf;
                // this.nbInfractionsPc = response.data.nbInfractionsPc;
                // this.nbInfractionsAutres = response.data.nbInfractionsAutres;
            });
        },
        remove: function(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    axios
                        .delete("infractions/" + id)
                        .then(response => {
                            this.index();
                            Swal.fire(
                                "Deleted!",
                                "brigade has been deleted.",
                                "success"
                            );
                        })
                        .catch(error => {
                            //this.errors=error.response.data.errors
                            console.log(error.response.data);
                            Swal.fire(
                                "Failed!",
                                "brigade has not been deleted.",
                                "error"
                            );
                        });
                }
            });
        },
        edit: function(infraction) {
            this.errors = [];
            this.is_edit = true;
            this.code = infraction.code;
            this.libelle = infraction.libelle;
            this.libelle_fr = infraction.libelle_fr;
            this.lois = infraction.lois;
            this.articles = infraction.articles;
            this.lois_p = infraction.lois_p;
            this.articles_p = infraction.articles_p;
            this.amande = infraction.amande;
            //this.resultat_id=infraction.resultat_id;
            this.id_update = infraction.id;

            $("#CreateModal").modal("show");
        },
        creating: function() {
            this.is_edit = false;
            this.code = "";
            this.libelle = "";
            this.libelle_fr = "";
            this.lois = "";
            this.articles = "";
            this.lois_p = "";
            this.articles_p = "";
            this.amande = "";
            //this.resultat_id='';
        },
        update: function() {
            axios
                .put("infractions/" + this.id_update, {
                    code: this.code,
                    libelle: this.libelle,
                    libelle_fr: this.libelle_fr,
                    lois: this.lois,
                    articles: this.articles,
                    lois_p: this.lois_p,
                    articles_p: this.articles_p,
                    amande: this.amande
                })
                .then(response => {
                    this.$Progress.start();
                    $("#CreateModal").modal("hide");
                    this.index();
                    this.showMessage("updated successfully", "success");
                    this.$Progress.finish();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$Progress.fail();
                });
            //   this.code='';
            //   this.libelle='';
            //   this.libelle_fr='';
            //   this.lois='';
            //   this.articles='';
            //   this.lois_p='';
            //   this.articles_p='';
            //   this.corp_id='';
            //   this.resultat_id='';
        },
        index: function() {
            axios
                .get("infractions")
                .then(response => {
                    //console.log(response);
                    this.infractions = response.data.infractions;
                    // this.resultat_id = response.data.resultat_id;
                    //  this.nbInfractionsRf = response.data.nbInfractionsRf;
                    // this.nbInfractionsPc = response.data.nbInfractionsPc;
                    // this.nbInfractionsAutres = response.data.nbInfractionsAutres;
                })
                .catch(error => (this.errors = error.response.data.errors));
        },
        create: function() {
            axios
                .post("infractions", {
                    code: this.code,
                    libelle: this.libelle,
                    libelle_fr: this.libelle_fr,
                    lois: this.lois,
                    articles: this.articles,
                    lois_p: this.lois_p,
                    articles_p: this.articles_p,
                    amande: this.amande
                })
                .then(response => {
                    this.$Progress.start();
                    $("#CreateModal").modal("hide");
                    this.index();
                    this.showMessage("created successfully", "success");
                    this.$Progress.finish();
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$Progress.fail();
                });
            // this.code='';
            // this.libelle='';
            // this.libelle_fr='';
            // this.lois='';
            // this.articles='';
            // this.lois_p='';
            // this.articles_p='';
            // this.corp_id='';
            // this.resultat_id='';
        },
        searching: function() {
            if (!this.search) {
                this.index();
            } else {
                axios
                    .get("infractions/search/" + this.search, {
                        headers: {
                            "Content-Type":
                                "application/x-www-form-urlencoded; charset=UTF-8"
                        }
                    })
                    .then(
                        response =>
                            (this.infractions = response.data.infractions)
                    );
            }
        },
        showMessage: function(message, type) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: toast => {
                    toast.addEventListener("mouseenter", Swal.stopTimer);
                    toast.addEventListener("mouseleave", Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }
    }
};
</script>
