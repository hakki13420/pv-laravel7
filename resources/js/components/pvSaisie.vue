<template>
    <div v-if="pvdata" dir="rtl" id="pv-content">
        <a @click.prevent="printPv" class="btn btn-primary float-right text-white">طباعة</a>
       <div class="page-1">
           <div>
                <div class="header text-center">
                    <h3>الملـحق</h3>
                </div>
                <div class="qrcode float-right">
                    <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
                </div>
                <div class="header text-center clear">
                    <h4 class="mb-2">محضر جرد (جدول الجرد) المواد العتاد و التجهيزات المحجوزة المرفقة بمحضر معاينة المخالفة</h4>
                </div>

                <div class="enregistrement">
                    <div>رقم و تاريخ محضر معاينة المخالفة : <span>{{pv.num_pv}} الؤرخ في {{pv.date_pv}}</span></div>
                    <div>رقم تسجيل محضر الجرد في سجل المنازعات : <span>{{tsaisie.num_saisie}}</span> </div>
                    <div>هوية، نشاط، رقم السجل التجاري و عنوان مرتكب المخالفة :<span>{{commercant}} </span> </div>
                </div>
            </div>
            <div class="content mt-4">
                <div class="first">أولا - جرد المواد:</div>
                <div class="matieres">
                    <table border="1px" class="table table-sm table-responsive text-wrap">
                        <thead>
                            <td style="width:15%;">الطبيعة</td>
                            <td style="width:15%;">الكمية</td>
                            <td style="width:15%;">تاريخ و مكان إجراء الجرد</td>
                            <td style="width:25%;">مكان الإيداعو كيفيات الحراسة (مرتكب المخالفة أو مصالح أملاك الدولة)</td>
                            <td style="width:15%;">القيمة الوحدوية</td>
                            <td style="width:15%;">القيمة الإجمالية مع كل الرسوم</td>
                        </thead>
                        <tbody>
                            <tr v-for="product in produits_saisie" :key="product.id">
                                <td>{{product.product}}</td>
                                <td>{{product.qte}}</td>
                                <td>{{tsaisie.date_saisie}} - {{tsaisie.lieux_saisie}} </td>
                                <td>{{tsaisie.depot_saisie}}</td>
                                <td>{{product.pu}}</td>
                                <td>{{product.somme}}</td>
                            </tr>
                        </tbody>
                    </table>

                </div>

                <div class="emergement">
                    <div class="float-left">
                        <div class="agents-header">إسم، لقب، صفة و إمضاء الموظفين الذين قاموا بعملية الجرد</div>
                        <div class="agents">
                            <div>{{agent1}}  {{grade1}}</div>
                            <div>{{agent2}}  {{grade2}}</div>
                            <div v-if="agent3">{{agent3}}  {{grade3}}</div>
                        </div>
                    </div>
                    <div class="float-right">
                        <div class="commercant-header">إسم، لقب و إمضاء مرتكب المخالفة</div>
                        <div class="commercant">{{commercant}}</div>
                    </div>
                </div>
                <div class="clear"></div>

            </div>
        </div>

    </div>
</template>

<script>
    import QrcodeVue from 'qrcode.vue'
    export default {
        mounted() {
            //console.log('Component mounted.');
            //this.index();
            //this.getResults();
            if(this.$route.params.pv_id != undefined){
                axios.get('pvSaisie/'+this.$route.params.pv_id)
                .then(response  => {

                    //this.value=response.data.actual_link;
                    this.value="http://www.zandal.net/pvs/public/home#/pvSaisie/"+this.$route.params.pv_id;

                    //'http://127.0.0.1:8000/home#/pvsPrint/'+this.$route.params.pv_id;
                    //this.value='http://www.google.fr';

                    this.pv=response.data.pv;
                    this.grades=response.data.grades;


                    this.tsaisie=response.data.tsaisie;

                    this.produits_saisie=response.data.produits_saisie;

                    this.agent1=this.pv.user1.name;
                    this.agent2=this.pv.user2.name;

                    this.grade1=this.getGrade(this.pv.user1.grade_id);
                    this.grade2=this.getGrade(this.pv.user2.grade_id);
                    if(this.pv.user3){
                        this.agent3=this.pv.user3.name;
                        this.grade3=this.getGrade(this.pv.user2.grade_id);
                        this.carte_com3=this.pv.user3.carte_com;
                        this.date_carte_com3=this.pv.user3.date_carte_com;
                    }



                    this.service=this.pv.service.service;


                    this.commercant=this.pv.commercant.name;
                    this.date_nais=this.pv.commercant.date_n;
                    //this.lieux_nais=this.pv.commercant.lieux_n;

                    this.domicile=this.pv.commercant.adresse_d;

                    this.activite=response.data.activite;
                    this.adresse=this.pv.adresse_com.adresse_com;



                    this.pvdata=true;

                });
            }

        },
        watch:{


        },
        components: {
            QrcodeVue,
        },
        data(){
            return {

                'date_pv':'',

                'agent1':'',
                'agent2':'',
                'agent3':'',
                'grade1':'',
                'grade2':'',
                'grade3':'',
                'service':'',

                'commercant':'',
                'date_nais':'',
                'lieux_nais':'',

                'domicile':'',
                'activite':'',
                'adresse':'',

                'value': '',
                'size': 100,



                'pvdata':false,


                'created_by':'',
                'id_update':'',
                pvs:{},
                grades:{},

                tsaisie:{},
                produits_saisie:{},

                errors:[],


            }
        },
        methods:{

            printPv:function(){
                window.print();
            },
            getGrade:function(id){
                let grade = this.grades.find((element) => element.id === id);

                return grade?grade.grade:"";
            }


        }
    }
</script>
<style scoped>
    @media print{
        #pv-content * {
            visibility: visible;
        }
        p{
            visibility: visible!important;
        }

        .page-1{
            height: 290mm;
            width: 240mm;
            margin: 0 auto;
            padding:10mm 0;
            page-break-after: always;
        }
        .page-3{
            page-break-after: unset;
        }
        .btn{
            display: none!important;
        }

    }
    @media screen and (max-width: 414px) and (min-width: 200px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.6em;
        }
        .header h4{
            font-size:.55em;
        }
        .header{
            height: 40px!important;
        }
        .enregistrement div{
            font-size:.55em!important;
        }
        .first{
            font-size:.7em!important;
        }
        .matieres table{
            font-size:.35em!important;
        }
        .agents, .agents-header, .commercant, .commercant-header{
            font-size:.35em!important;
        }


    }
      @media screen and (max-width: 576px) and (min-width: 414px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.75em;
        }
        .header h4{
            font-size:.65em;
        }
        .header{
            height: 50px!important;
        }
        .enregistrement div{
            font-size:.65em!important;
        }
        .first{
            font-size:.8em!important;
        }
        .matieres table{
            font-size:.45em!important;
        }
        .agents, .agents-header, .commercant, .commercant-header{
            font-size:.45em!important;
        }


    }
      @media screen and (max-width: 992px) and (min-width: 576px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.1em;
        }
        .header h4{
            font-size:.9em;
        }
        .header{
            height: 60px!important;
        }
        .enregistrement div{
            font-size:.9em!important;
        }
        .first{
            font-size:1em!important;
        }
        .matieres table{
            font-size:.6em!important;
        }
        .agents, .agents-header, .commercant, .commercant-header{
            font-size:.6em!important;
        }
      }
        @media screen and (max-width: 1200px) and (min-width: 992px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.3em;
        }
        .header h4{
            font-size:1.1em;
        }
        .header{
            height: 70px!important;
        }
        .enregistrement div{
            font-size:1.1em!important;
        }
        .first{
            font-size:1.2em!important;
        }
        .matieres table{
            font-size:.9em!important;
        }
        .agents, .agents-header, .commercant, .commercant-header{
            font-size:.85em!important;
        }
    }
     @media screen and (min-width: 1200px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.5em;
        }
        .header h4{
            font-size:1.3em;
        }
        .header{
            height: 80px!important;
        }
        .enregistrement div{
            font-size:1.4em!important;
        }
        .first{
            font-size:1.4em!important;
        }
        .matieres table{
            font-size:1.1em!important;
        }
        .agents, .agents-header, .commercant, .commercant-header{
            font-size:1em!important;
        }
    }

    .content{
        font-size: 18px;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }
    .page-1{
       /* width: 240mm;
         to centre page on screen*/
        margin-left: 10mm;
        margin-right: 10mm;
        padding:10mm 0;
    }
    .header{
        height: 80px;
    }

    .header h4{
        width:60%;
        margin:0 auto;
    }
    .enregistrement{
        margin: 50px 0;
    }
    .enregistrement div{
        margin: 10px 0;
        font-size: 19px;
    }
    .first{
        font-weight: bold;
        margin-bottom: 20px;;
    }
    .clear{
        clear: both;
    }
    table thead td{
        text-align: center;
        font-weight: bold;
    }
    table tbody td{
        text-align: center;
    }
    .page{
        float: left;
        border: 1px solid;
        border-radius: 3px;
        padding: 4px 5px;
    }
    .matiers, .emergement{
        margin: 20px 0;
    }
    .agents-header{
        width: 60%;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .commercant-header{
        width: 60%;
        margin-bottom: 20px;
        font-weight: bold;
    }
    .commercant,.agents{
        width: 100%;
    }
    .commercant div,.agents div{
        margin:20px 0
    }

</style>
