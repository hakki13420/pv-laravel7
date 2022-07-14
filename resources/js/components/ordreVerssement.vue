<template>
    <div v-if="pvdata" dir="rtl" id="pv-content">
        <a @click.prevent="printPv" class="btn btn-primary float-right text-white">طباعة</a>
       <div class="page-1">

           <div class="text-center">
                <div class="header">
                    <h3>الجمهوريـــة الجزائريـــة الدموقراطيـــة الشعبيـــة</h3>
                </div>
                <div class="clear">
                    <div class="qrcode float-right">
                        <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
                    </div>
                    <div class="float-left ministere">
                        <div>وزارة التجارة</div>
                        <div>مديرية التجارة لولاية تلمسان</div>
                        <div>رقم الإرسال</div>
                        <div>رقم القضية</div>
                    </div>
                </div>
                <br>

                <div class="commercant clear">
                    <h2 class="underline">مديــر التجارة</h2>
                    <div class="data-commercant">
                        <div>إلى السيد : <span>{{commercant}}</span></div>
                        <div>إبن : <span>{{pere}}</span> و <span>{{mere}}</span></div>
                        <div>العنوان : <span>{{adresse}}</span></div>
                    </div>
                </div>
                <div class="header">
                    <h1 class="underline">أمـــر بالدفع</h1>
                </div>
            </div>
            <div class="content mt-4">
                <div class="line">بناءا لأحكام المتدة 60 من القانون رقم 04-02 المؤرخ في 23-06-2004 المحدد للقواعد المطبقة على الممارسات التجارسة</div>
                <div class="line">و بناءا على المحضر الذي حرر ضدكم يوم <span>{{pv.date_pv}}</span> و المسجل تحت رقم : <span>{{pv.num_pv}}</span></div>
                <div class="line">بتاريخ <span>{{pv.date_pv}} </span>من طرف :{{service}}</div>
                <div class="line">لإرتكابكم :</div>
                <div class="infractions">
                    <table border="1px" class="table table-responsive table-sm text-wrap">
                        <thead>
                            <td style="width:42%;font-weight: bold;">المخالفة</td>
                            <td style="width:20%;font-weight: bold;">المنصوص عليها في أحكام المادة</td>
                            <td style="width:20%;font-weight: bold;">المعاقب عليها بنص المادة</td>
                            <td style="width:18%;font-weight: bold;">الغرامة (دج)</td>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div v-for="infraction in infractions" :key="infraction.id">
                                        {{infraction.libelle}}
                                    </div>
                                </td>
                                <td>{{articles}} من  {{lois}}</td>
                                <td>{{articles_p}} من  {{lois_p}}</td>
                                <td v-once>{{pv.amande}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="line">و لإنهاء هذه القضية فإنكم ملزمون بدفع غرامة مالية قدرها :</div>
                <div class="line">بالأرقام : <span>{{pv.amande}} دج</span></div>
                <div class="line">بالأحرف : <span>{{amande_lettre}} دينار جزائري</span></div>
                <div class="line">لذا عليكم الإتصال بمصالح خزينة ولاية تلمسان لدفع المبلغ المحدد أعلاه في الحساب رقم500.041 أو القيام بالدفع لدى خزينة البلدية لمقر إقامتكم</div>
                <div class="line">أحيطكم علما أنه في حالة عدم دفع مبلغ هذه الغرامة في الآجال المحددة سوف يحال ملفكم على تالمحكمة المختصة إقليمياللفصل فيه طبقا للقانون</div>
                <div class="line"><span>تنبيه :</span> يجب تقديم وصل التسديد لمديرية التجارة أو لمفتشية التجارة الأقرب من مقر إقامتكم و ذلك لتمكيننا من حفظ الملف</div>

                <div class="directeur underline"><h4>المديــر</h4></div>

                <hr>
                <div class="footer">
                    <div class="row">
                             <div class="col-4">
                        <div>{{configuration[0].ministere}}</div>
                        <div>{{configuration[0].organisme}}</div>
                    </div>
                    <div class="col-4">
                        <div>العنوان :{{configuration[0].adresse}}</div>
                        <div>البريد الإليكتروني :{{configuration[0].email}}</div>
                        <div>الموقع الإليكتروني :{{configuration[0].site}}</div>
                    </div>
                    <div class="col-4">
                        <div>الهاتف :{{configuration[0].tel}}</div>
                        <div>الفاكس :{{configuration[0].fax}}</div>
                    </div>
                    </div>
                </div>

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
                axios.get('ordreVerssement/'+this.$route.params.pv_id)
                .then(response  => {

                    //this.value=response.data.actual_link;
                    this.value="http://www.zandal.net/pvs/public/home#/ordreVerssement/"+this.$route.params.pv_id;

                    this.pv=response.data.pv;
                    this.amande_lettre=response.data.amande_lettre;


                    this.lieux_nais=response.data.commune_n;
                    this.infractions=response.data.infractions;
                    this.configuration=response.data.configuration;

                    this.infractions.forEach(element => {
                        let lois = this.infractions_lois.find((el) => el === element.lois);
                        let articles = this.infractions_articles.find((el) => el === element.articles);
                        let lois_p = this.infractions_lois_p.find((el) => el === element.lois_p);
                        let articles_p = this.infractions_articles_p.find((el) => el === element.articles_p);
                        if(lois==undefined){this.infractions_lois.push(element.lois);}
                        if(articles==undefined){this.infractions_articles.push(element.articles);}
                        if(lois_p==undefined){this.infractions_lois_p.push(element.lois_p);}
                        if(articles_p==undefined){this.infractions_articles_p.push(element.articles_p);}
                    });

                    this.lois=this.infractions_lois.join('-');
                    this.lois_p=this.infractions_lois_p.join('-');
                    this.articles=this.infractions_articles.join('-');
                    this.articles_p=this.infractions_articles_p.join('-');


                    //this.date_pv=this.jour[new Date(this.pv.date_pv).getDate()];

                    this.service=this.pv.service.service;

                    this.date_constat=this.pv.date_constat;
                    this.commercant=this.pv.commercant.name;
                    if(this.pv.commercant.rais_soc != "" && this.pv.commercant.rais_soc != "/"
                        && this.pv.commercant.rais_soc != null){
                        this.commercant+=" مسير "+this.pv.commercant.rais_soc;
                    }
                    this.date_nais=this.pv.commercant.date_n;
                    //this.lieux_nais=this.pv.commercant.lieux_n;
                    this.pere=this.pv.commercant.pere;
                    this.mere=this.pv.commercant.mere;
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

                'service':'',

                'date_constat':'',
                'commercant':'',
                'date_nais':'',
                'lieux_nais':'',
                'pere':'',
                'mere':'',
                'domicile':'',
                'activite':'',
                'adresse':'',
                'amande_lettre':'',

                'lois':'',
                'articles':'',
                'lois_p':'',
                'articles_p':'',

                'value': '',
                'size': 100,



                'pvdata':false,


                'created_by':'',
                'id_update':'',
                pvs:{},

                infractions:{},
                configuration:{},
                infractions_lois:[],
                infractions_articles:[],
                infractions_lois_p:[],
                infractions_articles_p:[],


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

        .page-1{
            height: 290mm;
            width: 240mm;
            margin: 0 auto;
            padding:10mm 0;
           /* page-break-after: always;*/
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
        .ministere div{
            font-size:.55em;
        }
        .commercant{
            height: 140px!important;
        }
        .commercant h2{
            font-size:.95em;
        }

        .data-commercant div {
            font-size:.75em!important;
            left: -54px!important;
        }
        .header h1{
            font-size:1.2em!important;
        }
        .line{
            font-size:.6em!important;
        }
        .infractions table{
            font-size:.6em!important;
        }
        .directeur h4{
            font-size:.9em!important;
        }
        .footer{
            font-size:.4em!important;
        }
    }
    @media screen and (max-width: 576px) and (min-width: 414px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.65em;
        }
        .ministere div{
            font-size:.6em;
        }
        .commercant{
            height: 150px!important;
        }
        .commercant h2{
            font-size:.95em;
        }
        .data-commercant div{
            font-size:.75em!important;
            left: -90px!important;
        }
        .header h1{
            font-size:1.3em!important;
        }
        .line{
            font-size:.7em!important;
        }
        .infractions table{
            font-size:.6em!important;
        }
        .directeur h4{
            font-size:.9em!important;
        }
        .footer{
            font-size:.5em!important;
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
        .ministere div{
            font-size:.95em;
        }
        .commercant{
            height: 160px!important;
        }
        .commercant h2{
            font-size: 1.1em;
        }
        .data-commercant div{
            font-size:.9em!important;
            left: -180px!important;
        }
        .header h1{
            font-size:1.4em!important;
        }
        .line{
            font-size:.85em!important;
        }
        .infractions table{
            font-size:.8em!important;
        }
        .directeur h4{
            font-size:1em!important;
        }
        .footer{
            font-size:.7em!important;
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
        .ministere div{
            font-size: 1.2em;
        }
        .commercant{
            height: 170px!important;
        }
        .commercant h2{
            font-size: 1.3em;
        }
        .data-commercant div{
            font-size:1.1em!important;
            left: -240px!important;
        }
        .header h1{
            font-size:1.5em!important;
        }
        .line{
            font-size:1em!important;
        }
        .infractions table{
            font-size:1em!important;
        }
        .directeur h4{
            font-size:1.2em!important;
        }
        .footer{
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
        /*width: 240mm;
         to centre page on screen*/
        margin-left: 10mm;
        margin-right: 10mm;
        padding:10mm 0;
    }
    .ministere{
        font-size: 18px;
        text-align: right;
    }
    .header{
        height: 80px;
    }
    .commercant{
        height: 180px;
        margin-bottom: 60px;
        position: relative;
        left: 0;
    }
    .underline{
        text-decoration: underline;
    }
    .commercant h2{
        margin-bottom: 60px;
    }
    .data-commercant div {
        height: 30px;
        font-size: 19px;
        text-align: right;
        width: 50%;
        position: relative;
        left: -320px;
    }
    .line{
        margin: 15px 0;
    }
    .directeur{
        text-align: center;
        margin: 18px 0 125px 0;
    }

    .data-box{
        border-bottom: 1px dashed;
        text-align: center;
        display:inline-block;
        position: relative;
        top: -7px;
    }

    .footer{
        font-size: 13px;
        text-align: center;
    }

    .clear{
        clear: both;
    }
    table thead td, table tbody tr td{
        text-align: center;
    }
    .page{
        float: left;
        border: 1px solid;
        border-radius: 3px;
        padding: 4px 5px;
    }
</style>
