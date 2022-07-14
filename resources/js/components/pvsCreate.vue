<template>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 v-if="!is_edit" class="card-title">
                            إنشاء محضر رسمي
                        </h3>
                        <h3 v-else class="card-title">تعديل محضر رسمي</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <form>
                            <div class="accordion" id="accordionExample">
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseZero"
                                                aria-expanded="false"
                                                aria-controls="collapseZero"
                                            >
                                                التسجيل
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseZero"
                                        class="collapse"
                                        aria-labelledby="headingThree"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="num_pv"
                                                            >رقم المحضر</label
                                                        >
                                                        <input
                                                            v-if="errors.num_pv"
                                                            type="text"
                                                            class="form-control is-invalid"
                                                            v-model="num_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            class="form-control"
                                                            v-model="num_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <span
                                                            v-if="errors.num_pv"
                                                            class="text-danger"
                                                            >{{
                                                                errors.num_pv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="date_pv"
                                                            >تاريخ المحضر</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.date_pv
                                                            "
                                                            type="date"
                                                            class="form-control is-invalid"
                                                            v-model="date_pv"
                                                            placeholder="تاريخ المحضر"
                                                        />
                                                        <input
                                                            v-else
                                                            type="date"
                                                            class="form-control"
                                                            v-model="date_pv"
                                                            placeholder="تاريخ المحضر"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.date_pv
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .date_pv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="hour_pv"
                                                            >ساعة المحضر</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.hour_pv
                                                            "
                                                            hour_pv="text"
                                                            class="form-control is-invalid"
                                                            v-model="hour_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <input
                                                            v-else
                                                            hour_pv="text"
                                                            class="form-control"
                                                            v-model="hour_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.hour_pv
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .hour_pv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="form-group">
                                                        <label for="min_pv"
                                                            >الدقائق</label
                                                        >
                                                        <input
                                                            v-if="errors.min_pv"
                                                            min_pv="text"
                                                            class="form-control is-invalid"
                                                            v-model="min_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <input
                                                            v-else
                                                            min_pv="text"
                                                            class="form-control"
                                                            v-model="min_pv"
                                                            placeholder="رقم المحضر"
                                                        />
                                                        <span
                                                            v-if="errors.min_pv"
                                                            class="text-danger"
                                                            >{{
                                                                errors.min_pv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseOne"
                                                aria-expanded="true"
                                                aria-controls="collapseOne"
                                            >
                                                المتعامل الاقتضادي
                                            </button>
                                        </h2>
                                    </div>

                                    <div
                                        id="collapseOne"
                                        class="collapse show"
                                        aria-labelledby="headingOne"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="commercant_id"
                                                        >
                                                            الاسم و اللقب</label
                                                        >
                                                        <select
                                                            v-if="
                                                                errors.commercant_id
                                                            "
                                                            name="commercant_id"
                                                            v-model="
                                                                commercant_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="commercant in commercants"
                                                                :key="
                                                                    commercant.id
                                                                "
                                                                v-bind:value="
                                                                    commercant.id
                                                                "
                                                                >{{
                                                                    commercant.name
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="commercant_id"
                                                            v-model="
                                                                commercant_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="commercant in commercants"
                                                                :key="
                                                                    commercant.id
                                                                "
                                                                v-bind:value="
                                                                    commercant.id
                                                                "
                                                                >{{
                                                                    commercant.name
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.commercant_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .commercant_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="adresse_com_id"
                                                            >العنوان التجاري
                                                        </label>
                                                        <select
                                                            v-if="
                                                                errors.adresse_com_id
                                                            "
                                                            name="adresse_com_id"
                                                            v-model="
                                                                adresse_com_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="adresse_com in adresse_coms"
                                                                :key="
                                                                    adresse_com.id
                                                                "
                                                                v-bind:value="
                                                                    adresse_com.id
                                                                "
                                                                >{{
                                                                    adresse_com.adresse_com
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="adresse_com_id"
                                                            v-model="
                                                                adresse_com_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="adresse_com in adresse_coms"
                                                                :key="
                                                                    adresse_com.id
                                                                "
                                                                v-bind:value="
                                                                    adresse_com.id
                                                                "
                                                                >{{
                                                                    adresse_com.adresse_com
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.adresse_com_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .adresse_com_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="activite_com_id"
                                                            >النشاط الممارس
                                                        </label>
                                                        <select
                                                            v-if="
                                                                errors.activite_com_id
                                                            "
                                                            name="activite_com_id"
                                                            v-model="
                                                                activite_com_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="activite_com in activite_coms"
                                                                :key="
                                                                    activite_com.id
                                                                "
                                                                v-bind:value="
                                                                    activite_com.id
                                                                "
                                                                >{{
                                                                    activite_com.libelle
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="activite_com_id"
                                                            v-model="
                                                                activite_com_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="activite_com in activite_coms"
                                                                :key="
                                                                    activite_com.id
                                                                "
                                                                v-bind:value="
                                                                    activite_com.id
                                                                "
                                                                >{{
                                                                    activite_com.libelle
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.activite_com_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .activite_com_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseTwo"
                                                aria-expanded="false"
                                                aria-controls="collapseTwo"
                                            >
                                                فرقة المراقبة
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseTwo"
                                        class="collapse"
                                        aria-labelledby="headingTwo"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="user1">
                                                            العون 1</label
                                                        >
                                                        <select
                                                            v-if="errors.user1"
                                                            name="user1"
                                                            v-model="user1"
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="user1"
                                                            v-model="user1"
                                                            class="form-control"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <span
                                                            v-if="errors.user1"
                                                            class="text-danger"
                                                            >{{
                                                                errors.user1[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="use2">
                                                            العون 2</label
                                                        >
                                                        <select
                                                            v-if="errors.user2"
                                                            name="user2"
                                                            v-model="user2"
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="user2"
                                                            v-model="user2"
                                                            class="form-control"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <span
                                                            v-if="errors.user2"
                                                            class="text-danger"
                                                            >{{
                                                                errors.user2[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="user3">
                                                            العون 3</label
                                                        >
                                                        <select
                                                            v-if="errors.user3"
                                                            name="user3"
                                                            v-model="user3"
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="user3"
                                                            v-model="user3"
                                                            class="form-control"
                                                        >
                                                            <option
                                                                :value="null"
                                                                >---------</option
                                                            >
                                                            <template
                                                                v-for="user in users"
                                                            >
                                                                <option
                                                                    v-bind:value="
                                                                        user.id
                                                                    "
                                                                    :key="
                                                                        user.id
                                                                    "
                                                                    >{{
                                                                        user.name
                                                                    }}</option
                                                                >
                                                            </template>
                                                        </select>
                                                        <span
                                                            v-if="errors.user3"
                                                            class="text-danger"
                                                            >{{
                                                                errors.user3[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="service_id">
                                                            المصلحة</label
                                                        >
                                                        <select
                                                            v-if="
                                                                errors.service_id
                                                            "
                                                            name="service_id"
                                                            v-model="service_id"
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="service in services"
                                                                :key="
                                                                    service.id
                                                                "
                                                                v-bind:value="
                                                                    service.id
                                                                "
                                                                >{{
                                                                    service.service
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="service_id"
                                                            v-model="service_id"
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="service in services"
                                                                :key="
                                                                    service.id
                                                                "
                                                                v-bind:value="
                                                                    service.id
                                                                "
                                                                >{{
                                                                    service.service
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.service_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .service_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseThree"
                                                aria-expanded="false"
                                                aria-controls="collapseThree"
                                            >
                                                المعاينة
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseThree"
                                        class="collapse"
                                        aria-labelledby="headingThree"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div
                                                    class="col-sm-12 col-md-6 col-xl-4"
                                                >
                                                    <div class="form-group">
                                                        <label for="num_conv"
                                                            >رقم
                                                            الاستدعاء</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.num_conv
                                                            "
                                                            num_conv="text"
                                                            class="form-control is-invalid"
                                                            v-model="num_conv"
                                                            placeholder="رقم الاستدعاء"
                                                        />
                                                        <input
                                                            v-else
                                                            num_conv="text"
                                                            class="form-control"
                                                            v-model="num_conv"
                                                            placeholder="رقم الاستدعاء"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.num_conv
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .num_conv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-xl-4"
                                                >
                                                    <div class="form-group">
                                                        <label for="date_conv"
                                                            >تاريخ
                                                            الإستدعاء</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.date_conv
                                                            "
                                                            type="date"
                                                            class="form-control is-invalid"
                                                            v-model="date_conv"
                                                            placeholder="تاريخ الاستدعاء"
                                                        />
                                                        <input
                                                            v-else
                                                            type="date"
                                                            class="form-control"
                                                            v-model="date_conv"
                                                            placeholder="النوع"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.date_conv
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .date_conv[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-xl-4"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="date_constat"
                                                            >تاريخ
                                                            المعاينة</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.date_constat
                                                            "
                                                            type="date"
                                                            class="form-control is-invalid"
                                                            v-model="
                                                                date_constat
                                                            "
                                                            placeholder="النوع"
                                                        />
                                                        <input
                                                            v-else
                                                            type="date"
                                                            class="form-control"
                                                            v-model="
                                                                date_constat
                                                            "
                                                            placeholder="النوع"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.date_constat
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                errors
                                                                    .date_constat[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseFour"
                                                aria-expanded="false"
                                                aria-controls="collapseFour"
                                            >
                                                المخالفات
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseFour"
                                        class="collapse"
                                        aria-labelledby="headingFour"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-8">
                                                    <div class="form-group">
                                                        <label
                                                            for="infraction_to_add"
                                                            >المخالفة</label
                                                        >
                                                        <select
                                                            v-model="
                                                                infraction_to_add
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="infraction in infractions"
                                                                :key="
                                                                    infraction.id
                                                                "
                                                                v-bind:value="
                                                                    infraction.id
                                                                "
                                                            >
                                                                {{
                                                                    infraction.libelle
                                                                }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div
                                                        class="input-group input-group-sm"
                                                    >
                                                        <button
                                                            @click.prevent="
                                                                add_infraction()
                                                            "
                                                            class="btn btn-primary btn-sm btn-block"
                                                        >
                                                            <i
                                                                class="fa fa-user-plus"
                                                            ></i>
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="amande"
                                                            >غرامة
                                                            المصالحة</label
                                                        >
                                                        <input
                                                            v-if="errors.amande"
                                                            type="text"
                                                            name="amande"
                                                            v-model="amande"
                                                            class="form-control is-invalid"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            name="amande"
                                                            v-model="amande"
                                                            class="form-control"
                                                        />
                                                        <span
                                                            v-if="errors.amande"
                                                            class="text-danger"
                                                            >{{
                                                                errors.amande[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />

                                            <div class="form-group">
                                                <table
                                                    class="table table-hover text-nowrap"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>الرقم</th>
                                                            <th>المخالفة</th>
                                                            <th>الخيارات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(infraction,
                                                            index) in infractions_commit"
                                                            :key="infraction.id"
                                                        >
                                                            <td>
                                                                {{ index + 1 }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    infraction.libelle
                                                                }}
                                                            </td>
                                                            <td>
                                                                <a
                                                                    class="dropdown-item"
                                                                    href=""
                                                                    @click.prevent="
                                                                        remove_infraction(
                                                                            infraction.infraction_id
                                                                        )
                                                                    "
                                                                    ><i
                                                                        class="fa fa-trash"
                                                                    ></i
                                                                ></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFour">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseSaisie"
                                                aria-expanded="false"
                                                aria-controls="collapseSaisie"
                                            >
                                                الحجز
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseSaisie"
                                        class="collapse"
                                        aria-labelledby="headingSaisie"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="typesaisie_id"
                                                            >نوع الحجز</label
                                                        >
                                                        <select
                                                            v-if="
                                                                errors.typesaisie_id
                                                            "
                                                            name="typesaisie_id"
                                                            v-model="
                                                                typesaisie_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="typesaisie in typesaisies"
                                                                :key="
                                                                    typesaisie.id
                                                                "
                                                                :value="
                                                                    typesaisie.id
                                                                "
                                                                >{{
                                                                    typesaisie.libelle
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="typesaisie_id"
                                                            v-model="
                                                                typesaisie_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="typesaisie in typesaisies"
                                                                :key="
                                                                    typesaisie.id
                                                                "
                                                                :value="
                                                                    typesaisie.id
                                                                "
                                                                >{{
                                                                    typesaisie.libelle
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.typesaisie_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .typesaisie_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label for="category_id"
                                                            >طبيعة
                                                            المحجوزات</label
                                                        >
                                                        <select
                                                            v-if="
                                                                errors.category_id
                                                            "
                                                            name="category_id"
                                                            v-model="
                                                                category_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="category in categories"
                                                                :key="
                                                                    category.id
                                                                "
                                                                :value="
                                                                    category.id
                                                                "
                                                                >{{
                                                                    typesaisie.libelle
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="category_id"
                                                            v-model="
                                                                category_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="category in categories"
                                                                :key="
                                                                    category.id
                                                                "
                                                                :value="
                                                                    category.id
                                                                "
                                                                >{{
                                                                    category.category
                                                                }}</option
                                                            >
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.category_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .category_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-group">
                                                        <label
                                                            for="sommeqte_saisie"
                                                            >كمية
                                                            المحجوزات</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.sommeqte_saisie
                                                            "
                                                            type="text"
                                                            name="sommeqte_saisie"
                                                            v-model="
                                                                sommeqte_saisie
                                                            "
                                                            class="form-control is-invalid bg-danger"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            name="sommeqte_saisie"
                                                            v-model="
                                                                sommeqte_saisie
                                                            "
                                                            class="form-control bg-danger"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.sommeqte_saisie
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .sommeqte_saisie[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-">
                                                    <div class="form-group">
                                                        <label
                                                            for="sommeDa_saisie"
                                                            >قيمة
                                                            المحجوزات</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.sommeDa_saisie
                                                            "
                                                            type="text"
                                                            name="sommeDa_saisie"
                                                            v-model="
                                                                sommeDa_saisie
                                                            "
                                                            class="form-control is-invalid bg-danger"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            name="sommeDa_saisie"
                                                            v-model="
                                                                sommeDa_saisie
                                                            "
                                                            class="form-control bg-danger"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.sommeDa_saisie
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .sommeDa_saisie[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label for="num_saisie"
                                                            >رقم الحجز</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.num_saisie
                                                            "
                                                            type="text"
                                                            name="num_saisie"
                                                            v-model="num_saisie"
                                                            class="form-control is-invalid"
                                                            placeholder="رقم الحجز"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            name="num_saisie"
                                                            v-model="num_saisie"
                                                            class="form-control"
                                                            placeholder="رقم الحجز"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.num_saisie
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .num_saisie[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label for="date_saisie"
                                                            >تاريخ الحجز</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.date_saisie
                                                            "
                                                            type="date"
                                                            name="date_saisie"
                                                            v-model="
                                                                date_saisie
                                                            "
                                                            class="form-control is-invalid"
                                                            placeholder="تاريخ الحجز"
                                                        />
                                                        <input
                                                            v-else
                                                            type="date"
                                                            name="date_saisie"
                                                            v-model="
                                                                date_saisie
                                                            "
                                                            class="form-control"
                                                            placeholder="تاريخ الحجز"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.date_saisie
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .date_saisie[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="lieux_saisie"
                                                            >مكان الحجز</label
                                                        >
                                                        <input
                                                            v-if="
                                                                errors.lieux_saisie
                                                            "
                                                            type="text"
                                                            name="lieux_saisie"
                                                            v-model="
                                                                lieux_saisie
                                                            "
                                                            class="form-control is-invalid"
                                                            placeholder="مكان الحجز"
                                                        />
                                                        <input
                                                            v-else
                                                            type="text"
                                                            name="lieux_saisie"
                                                            v-model="
                                                                lieux_saisie
                                                            "
                                                            class="form-control"
                                                            placeholder="مكان الحجز"
                                                        />
                                                        <span
                                                            v-if="
                                                                errors.lieux_saisie
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .lieux_saisie[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="depot_saisie_id"
                                                            >مكان إيداع
                                                            الحجز</label
                                                        >
                                                        <select
                                                            v-if="
                                                                errors.depot_saisie_id
                                                            "
                                                            name="depot_saisie_id"
                                                            v-model="
                                                                depot_saisie_id
                                                            "
                                                            class="form-control is-invalid"
                                                        >
                                                            <option
                                                                v-for="depot in depots"
                                                                :key="depot"
                                                                :value="depot"
                                                                >{{
                                                                    depot
                                                                }}</option
                                                            >
                                                        </select>
                                                        <select
                                                            v-else
                                                            name="depot_saisie_id"
                                                            v-model="
                                                                depot_saisie_id
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="depot in depots"
                                                                :key="depot"
                                                                :value="depot"
                                                                >{{
                                                                    depot
                                                                }}</option
                                                            >²
                                                        </select>
                                                        <span
                                                            v-if="
                                                                errors.depot_saisie_id
                                                            "
                                                            class="text-danger"
                                                            >{{
                                                                erros
                                                                    .depot_saisie_id[0]
                                                            }}</span
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3 col-3"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="product_to_add"
                                                            >مواد الحجز</label
                                                        >
                                                        <select
                                                            v-model="
                                                                product_to_add
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                v-for="product in products"
                                                                :key="
                                                                    product.id
                                                                "
                                                                v-bind:value="
                                                                    product.id
                                                                "
                                                            >
                                                                {{
                                                                    product.libelle
                                                                }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label for="qte_to_add"
                                                            >qte</label
                                                        >
                                                        <input
                                                            type="number"
                                                            @change="total"
                                                            name="qte_to_add"
                                                            v-model="qte_to_add"
                                                            class="form-control"
                                                        />
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="unite_to_add"
                                                            >unite</label
                                                        >
                                                        <select
                                                            name="unite_to_add"
                                                            v-model="
                                                                unite_to_add
                                                            "
                                                            class="form-control"
                                                        >
                                                            <option
                                                                value="u"
                                                                selected
                                                                >unite</option
                                                            >
                                                            <option value="Kg"
                                                                >Kg</option
                                                            >
                                                            <option value="g"
                                                                >gramme</option
                                                            >
                                                            <option value="l"
                                                                >litre</option
                                                            >
                                                            <option value="m"
                                                                >metre</option
                                                            >
                                                        </select>
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label for="pu_to_add"
                                                            >pu</label
                                                        >
                                                        <input
                                                            type="text"
                                                            @change="total"
                                                            name="pu_to_add"
                                                            v-model="pu_to_add"
                                                            class="form-control"
                                                        />
                                                    </div>
                                                </div>
                                                <div
                                                    class="col-sm-12 col-md-6 col-lg-4 col-xl-3"
                                                >
                                                    <div class="form-group">
                                                        <label
                                                            for="total_to_add"
                                                            >total</label
                                                        >
                                                        <input
                                                            type="text"
                                                            name="total_to_add"
                                                            v-model="
                                                                total_to_add
                                                            "
                                                            class="form-control"
                                                        />
                                                    </div>
                                                </div>
                                            </div>

                                            <div
                                                class="input-group input-group-sm"
                                            >
                                                <button
                                                    @click.prevent="
                                                        add_product()
                                                    "
                                                    class="btn btn-primary btn-sm btn-block"
                                                >
                                                    <i
                                                        class="fa fa-user-plus"
                                                    ></i>
                                                </button>
                                            </div>

                                            <div class="form-group">
                                                <table
                                                    class="table table-hover text-nowrap"
                                                >
                                                    <thead>
                                                        <tr>
                                                            <th>الرقم</th>
                                                            <th>المادة</th>
                                                            <th>الكمية</th>
                                                            <th>الوحدة</th>
                                                            <th>سعر الوحدة</th>
                                                            <th>المجموع</th>
                                                            <th>الخيارات</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr
                                                            v-for="(product,
                                                            index) in products_saisie"
                                                            :key="product.id"
                                                        >
                                                            <td>
                                                                {{ index + 1 }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    product.libelle
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    product.qte
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    product.unite
                                                                }}
                                                            </td>
                                                            <td>
                                                                {{ product.pu }}
                                                            </td>
                                                            <td>
                                                                {{
                                                                    product.total
                                                                }}
                                                            </td>
                                                            <td>
                                                                <a
                                                                    class="dropdown-item"
                                                                    href=""
                                                                    @click.prevent="
                                                                        remove_product(
                                                                            product.product_id
                                                                        )
                                                                    "
                                                                    ><i
                                                                        class="fa fa-trash"
                                                                    ></i
                                                                ></a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseFive"
                                                aria-expanded="false"
                                                aria-controls="collapseFive"
                                            >
                                                تحرير المحضر
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseFive"
                                        class="collapse"
                                        aria-labelledby="headingFive"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div
                                                class="mb-2 input-group input-group-sm d-flex justify-content-between"
                                                style="width: 100%;"
                                            >
                                                <div>
                                                    <label for="redaction"
                                                        >التحرير</label
                                                    >
                                                </div>
                                                <div>
                                                    <button
                                                        @click.prevent="
                                                            getredactions
                                                        "
                                                        class="bg-primary btn btn-sm"
                                                    >
                                                        التحرير
                                                    </button>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="row">
                                                <div class="col-sm-12 col-md-3">
                                                    <table
                                                        class="table rigth-table"
                                                    >
                                                        <tbody>
                                                            <tr>
                                                                <th>المخالف</th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .name
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .name
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    رقم السجل
                                                                    التجاري
                                                                </th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .nrc
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .nrc
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    التسمية
                                                                    الاجتماعية
                                                                </th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .rais_soc
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .rais_soc
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    تاريخ
                                                                    الازدياد
                                                                </th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .date_n
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .date_n
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>
                                                                    مكان
                                                                    الازدياد
                                                                </th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .lieux_n
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .lieux_n
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>الأب</th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .pere
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .pere
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                            <tr>
                                                                <th>الأم</th>
                                                                <th>
                                                                    <a
                                                                        v-if="
                                                                            commercants[0]
                                                                        "
                                                                        @click="
                                                                            insererText(
                                                                                commercants[0]
                                                                                    .mere
                                                                            )
                                                                        "
                                                                        class="btn text-danger"
                                                                        >{{
                                                                            commercants[0]
                                                                                .mere
                                                                        }}</a
                                                                    >
                                                                </th>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div class="form-group">
                                                        <textarea
                                                            dir="rtl"
                                                            name="redaction"
                                                            id="redaction"
                                                            class="form-control"
                                                            v-model="redaction"
                                                            cols="30"
                                                            rows="20"
                                                        ></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-3">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <table
                                                                class="table rigth-table"
                                                            >
                                                                <tbody>
                                                                    <tr>
                                                                        <th>
                                                                            النشاط
                                                                            الممارس
                                                                        </th>
                                                                        <th>
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        activite_com_pv
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    activite_com_pv
                                                                                }}</a
                                                                            >
                                                                        </th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>
                                                                            العنوان
                                                                        </th>
                                                                        <th>
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        adresse_com_pv
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    adresse_com_pv
                                                                                }}</a
                                                                            >
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-12">
                                                            <table
                                                                class="table rigth-table"
                                                            >
                                                                <tbody>
                                                                    <tr
                                                                        v-for="infraction in infractions_commit"
                                                                        :key="
                                                                            infraction.id
                                                                        "
                                                                    >
                                                                        <th>
                                                                            المخالفة
                                                                        </th>
                                                                        <th>
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        infraction.libelle
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    infraction.libelle
                                                                                }}</a
                                                                            >
                                                                        </th>
                                                                    </tr>
                                                                    <tr
                                                                        v-for="infraction in infractions_commit"
                                                                        :key="
                                                                            infraction.id
                                                                        "
                                                                    >
                                                                        <th>
                                                                            القانون
                                                                        </th>
                                                                        <th>
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        infraction.lois
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    infraction.lois
                                                                                }}</a
                                                                            >
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        infraction.articles
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    infraction.articles
                                                                                }}</a
                                                                            >
                                                                        </th>
                                                                    </tr>
                                                                    <tr
                                                                        v-for="infraction in infractions_commit"
                                                                        :key="
                                                                            infraction.id
                                                                        "
                                                                    >
                                                                        <th>
                                                                            المعاقب
                                                                            عليها
                                                                            في
                                                                        </th>
                                                                        <th>
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        infraction.lois_p
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    infraction.lois_p
                                                                                }}</a
                                                                            >
                                                                            <a
                                                                                @click="
                                                                                    insererText(
                                                                                        infraction.articles_p
                                                                                    )
                                                                                "
                                                                                class="btn text-danger"
                                                                                >{{
                                                                                    infraction.articles_p
                                                                                }}</a
                                                                            >
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header" id="headingFive">
                                        <h2 class="mb-0">
                                            <button
                                                class="btn btn-link btn-block text-left collapsed"
                                                type="button"
                                                data-toggle="collapse"
                                                data-target="#collapseCommentaires"
                                                aria-expanded="false"
                                                aria-controls="collapseCommentaires"
                                            >
                                                تصريح المخالف
                                            </button>
                                        </h2>
                                    </div>
                                    <div
                                        id="collapseCommentaires"
                                        class="collapse"
                                        aria-labelledby="headingCommentaire"
                                        data-parent="#accordionExample"
                                    >
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-8">
                                                    <div class="form-group">
                                                        <textarea
                                                            dir="rtl"
                                                            name="commentaires"
                                                            id="commentaires"
                                                            class="form-control"
                                                            v-model="
                                                                commentaires
                                                            "
                                                            cols="30"
                                                            rows="10"
                                                        ></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 col-md-4">
                                                    <div class="form-check">
                                                        <input
                                                            type="radio"
                                                            name="signature"
                                                            id="oui"
                                                            value="true"
                                                            v-model="signature"
                                                            class="form-check-input"
                                                        />
                                                        <label
                                                            for="oui"
                                                            class="form-check-label"
                                                            >وافق على
                                                            الإمضاء</label
                                                        >
                                                    </div>
                                                    <div class="form-check">
                                                        <input
                                                            type="radio"
                                                            name="signature"
                                                            id="non"
                                                            value="false"
                                                            v-model="signature"
                                                            class="form-check-input"
                                                        />
                                                        <label
                                                            for="non"
                                                            class="form-check-label"
                                                            >لم يوافق على
                                                            الإمضاء</label
                                                        >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button
                                    v-if="is_edit"
                                    type="submit"
                                    @click.prevent="update"
                                    class="btn btn-primary"
                                >
                                    تعدبل
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
                                    @click="$router.go(-1)"
                                >
                                    غلق
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal Models -->
        <div
            class="modal fade"
            id="showModelsModal"
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
                            تعديل نمودج
                        </h5>
                        <h5 v-else class="modal-title" id="exampleModalLabel">
                            إضافة نمودج
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
                        <table class="table table-hover text-wrap">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>infraction</th>
                                    <th>model</th>
                                    <th>actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="model_redaction in model_redactions"
                                    :key="model_redaction.id"
                                >
                                    <td>{{ model_redaction.id }}</td>
                                    <td>{{ model_redaction.infraction_id }}</td>
                                    <td>{{ model_redaction.model }}</td>
                                    <td>
                                        <a
                                            @click="
                                                selectionRedaction(
                                                    model_redaction
                                                )
                                            "
                                            class="btn btn-primary"
                                            >select</a
                                        >
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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
        //this.getResults();
        if (this.$route.params.pv_id != undefined) {
            axios
                .get("pvs/" + this.$route.params.pv_id + "/edit")
                .then(response => {
                    this.commercants = response.data.commercants;
                    //this.commercant_id=this.$route.params.commercant_id;
                    this.adresse_coms = response.data.adresse_coms;
                    //this.adresse_com_id=response.data.adresse_coms[0].id;
                    this.activite_coms = response.data.activite_coms;
                    //this.activite_com_id=response.data.activite_coms[0].id;
                    this.users = response.data.users;
                    //this.users.unshift(Null);
                    this.infractions = response.data.infractions;
                    this.services = response.data.services;
                    this.products = response.data.products;
                    this.typesaisies = response.data.typesaisies;
                    this.categories = response.data.categories;

                    //infractions du pvs
                    if (response.data.infraction_pv) {
                        response.data.infraction_pv.forEach(element => {
                            let infraction = this.infractions.find(
                                el => el.id === element.infraction_id
                            );
                            this.infractions_commit.push({
                                infraction_id: element.infraction_id,
                                libelle: infraction.libelle,
                                lois: infraction.lois,
                                lois_p: infraction.lois_p,
                                articles: infraction.articles,
                                articles_p: infraction.articles_p
                            });
                        });
                    }

                    //saisie
                    if (response.data.tsaisie) {
                        this.typesaisie_id =
                            response.data.tsaisie.typesaisie_id;
                        this.category_id = response.data.tsaisie.category_id;
                        this.num_saisie = response.data.tsaisie.num_saisie;
                        this.date_saisie = response.data.tsaisie.date_saisie;
                        this.lieux_saisie = response.data.tsaisie.lieux_saisie;
                        this.depot_saisie_id =
                            response.data.tsaisie.depot_saisie;
                        this.sommeqte_saisie = response.data.tsaisie.quantite;
                        this.sommeDa_saisie = response.data.tsaisie.sommeDa;
                    }

                    //produits de saisie
                    if (response.data.product_tsaisie) {
                        response.data.product_tsaisie.forEach(element => {
                            let product = this.products.find(
                                el => el.id === element.product_id
                            );
                            //console.log(infraction);
                            this.products_saisie.push({
                                product_id: element.product_id,
                                libelle: product.libelle,
                                qte: element.qte,
                                unite: element.unite,
                                pu: element.pu,
                                total: element.somme
                            });
                        });
                    }

                    this.edit(response.data.pv);
                });
        } else if (this.$route.params.commercant_id != undefined) {
            axios
                .get("pvsCreate/" + this.$route.params.commercant_id)
                .then(response => {
                    this.commercants = response.data.commercants;
                    this.commercant_id = this.$route.params.commercant_id;
                    this.adresse_coms = response.data.adresse_coms;
                    this.adresse_com_id = response.data.adresse_coms[0].id;
                    this.activite_coms = response.data.activite_coms;
                    this.activite_com_id = response.data.activite_coms[0].id;

                    this.users = response.data.users;
                    //this.users.unshift(Null);

                    this.user1 = this.users[0].id;
                    this.user2 = this.users[1].id;
                    if (this.users.length > 2) {
                        this.user3 = this.users[2].id;
                    }

                    this.infractions = response.data.infractions;

                    this.services = response.data.services;
                    this.service_id = this.services[0].id;

                    this.products = response.data.products;
                    this.typesaisies = response.data.typesaisies;
                    this.categories = response.data.categories;

                    this.date_pv = this.getDate();
                    this.date_constat = this.getDate();
                    this.date_conv = this.getDate();

                    let now = new Date();
                    this.hour_pv = now.getHours();
                    this.min_pv = now.getMinutes();

                    this.adresse_com_pv =
                        response.data.adresse_coms[0].adresse_com;
                    this.activite_com_pv =
                        response.data.activite_coms[0].activite.libelle;
                });
        } else {
            axios.get("pvs/create").then(response => {
                this.commercants = response.data.commercants;
                this.adresse_coms = response.data.adresse_coms;
                this.activite_coms = response.data.activite_coms;
                this.users = response.data.users;
                this.services = response.data.services;
                this.infractions = response.data.infractions;
                this.products = response.data.products;
                this.typesaisies = response.data.typesaisies;
                this.categories = response.data.categories;

                this.date_pv = this.getDate();
                this.date_constat = this.getDate();

                let now = new Date();
                this.hour_pv = now.getHours();
                this.min_pv = now.getMinutes();
            });
        }
    },

    computed: {
        total: function() {
            if (this.qte_to_add != undefined && this.pu_to_add != undefined) {
                return (this.total_to_add = this.qte_to_add * this.pu_to_add);
            }
        }
    },
    data() {
        return {
            num_pv: "",
            date_pv: "",
            hour_pv: "",
            min_pv: "",

            commercant_id: "",
            adresse_com_id: "",
            adresse_com_pv: "",
            activite_com_id: "",
            activite_com_pv: "",
            user1: null,
            user2: null,
            user3: null,
            service_id: "",
            date_conv: "",
            num_conv: "",
            date_constat: "",
            infraction_to_add: "",
            amande: "",

            product_to_add: "",
            qte_to_add: "",
            unite_to_add: "",
            total_to_add: "",
            pu_to_add: "",
            category_id: "",
            num_saisie: "",
            date_saisie: "",
            lieux_saisie: "",
            depot_saisie_id: "",
            sommeDa_saisie: "",
            sommeqte_saisie: "",
            typesaisie_id: "",

            infraction_id: "",
            redaction: "",
            commentaires: "",
            signature: false,

            created_by: "",
            id_update: "",
            //pvs:{},
            commercants: {},
            adresse_coms: {},
            activite_coms: {},
            users: {},
            services: {},
            infractions: {},
            typesaisies: {},
            categories: {},
            products: {},
            infractions_commit: [],
            products_saisie: [],
            model_redactions: {},

            errors: [],
            depots: ["مرتكب المخالفة", "مصالح أملاك الدولة"],
            is_edit: false,
            show_models: false,
            search: ""
        };
    },
    methods: {
        edit: function(pv) {
            console.log(pv);
            this.errors = [];
            this.is_edit = true;
            this.num_pv = pv.num_pv;
            this.date_pv = pv.date_pv;
            this.hour_pv = pv.hour_pv;
            this.min_pv = pv.min_pv;
            this.commercant_id = pv.commercant_id;
            this.adresse_com_id = pv.adresse_com_id;
            this.activite_com_id = pv.activite_com_id;
            this.user1 = pv.user1;
            this.user2 = pv.user2;
            this.user3 = pv.user3;
            this.service_id = pv.service_id;
            this.date_constat = pv.date_constat;
            this.num_conv = pv.num_conv;
            this.date_conv = pv.date_conv;
            this.commentaires = pv.commentaires;
            this.redaction = pv.redaction;
            this.amande = pv.amande;
            this.signature = pv.signature ? "true" : "false";
            this.created_by = pv.created_by;
            this.id_update = pv.id;

            //this.activite_com_pv=pv.activite_com_id;
            //this.adresse_com_pv=pv.adresse_com_id;

            //this.adresse_com_pv=response.data.adresse_coms[0].adresse_com;
            this.adresse_com_pv = this.adresse_coms.find(
                element => element.id == this.adresse_com_id
            ).adresse_com;
            this.activite_com_pv = this.activite_coms.find(
                element => element.id == this.activite_com_id
            ).libelle;

            //$('#CreateModal').modal('show');
        },
        creating: function() {
            this.is_edit = false;
            this.initialize();
        },
        getredactions: function() {
            if (this.infractions_commit.length != 0) {
                this.infraction_id = this.infractions_commit[0].infraction_id;
                console.log(this.infraction_id);
                axios
                    .get("getredactions/" + this.infraction_id)
                    .then(response => {
                        this.model_redactions = response.data.model_redactions;
                        $("#showModelsModal").modal("show");
                    });
            } else {
                alert("يجب إدخال المخالفة في الخانة المخصصة");
            }
        },
        closeModal() {
            $("#showModelsModal").modal("hide");
        },
        selectionRedaction: function(model_redaction) {
            this.redaction = model_redaction.model;
            $("#showModelsModal").modal("hide");
        },
        insererText: function(text) {
            var cursorPos = $("#redaction").prop("selectionStart");
            var v = $("#redaction").val();
            var textBefore = v.substring(0, cursorPos);
            var textAfter = v.substring(cursorPos, v.length);

            $("#redaction").val(textBefore + text + textAfter);
            this.redaction = $("#redaction").val();
        },
        initialize: function() {
            this.num_pv = "";
            this.date_pv = "";
            this.hour_pv = "";
            this.min_pv = "";
            this.commercant_id = "";
            this.adresse_com_id = "";
            this.activite_com_id = "";
            this.user1 = "";
            this.user2 = "";
            this.user3 = "";
            this.service_id = "";
            this.date_conv = "";
            this.num_conv = "";
            this.date_constat = "";
            this.adresse_com_pv = "";
            this.activite_com_pv = "";
            this.redaction = "";
            this.created_by = "";
        },
        update: function() {
            axios
                .put("pvs/" + this.id_update, {
                    num_pv: this.num_pv,
                    date_pv: this.date_pv,
                    commercant_id: this.commercant_id,
                    hour_pv: this.hour_pv,
                    min_pv: this.min_pv,
                    adresse_com_id: this.adresse_com_id,
                    activite_com_id: this.activite_com_id,
                    user1: this.user1,
                    user2: this.user2,
                    user3: this.user3,
                    service_id: this.service_id,
                    date_conv: this.date_conv,
                    num_conv: this.num_conv,
                    date_constat: this.date_constat,
                    commentaires: this.commentaires,
                    redaction: this.redaction,
                    infractions: this.infractions_commit,
                    amande: this.amande,
                    products_saisie: this.products_saisie,
                    sommeqte: this.sommeqte_saisie,
                    sommeDa: this.sommeDa_saisie,
                    category_id: this.category_id,
                    typesaisie_id: this.typesaisie_id,
                    signature: this.signature,
                    date_saisie: this.date_saisie,
                    lieux_saisie: this.lieux_saisie,
                    depot_saisie: this.depot_saisie_id,
                    num_saisie: this.num_saisie
                })
                .then(response => {
                    this.$Progress.start();
                    $("#CreateModal").modal("hide");
                    this.showMessage("updated successfully", "success");
                    this.$Progress.finish();
                    if (this.$route.params.commercant_id != undefined) {
                        window.location.replace(
                            "./home#/commercantPvs/" +
                                this.$route.params.commercant_id
                        );
                    } else if (this.$route.params.pv_id != undefined) {
                        window.location.replace("./home#/pvs");
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$Progress.fail();
                });
            //this.initialize();
        },
        create: function() {
            axios
                .post("pvs", {
                    num_pv: this.num_pv,
                    date_pv: this.date_pv,
                    commercant_id: this.commercant_id,
                    hour_pv: this.hour_pv,
                    min_pv: this.min_pv,
                    adresse_com_id: this.adresse_com_id,
                    activite_com_id: this.activite_com_id,
                    user1: this.user1,
                    user2: this.user2,
                    user3: this.user3,
                    service_id: this.service_id,
                    date_conv: this.date_conv,
                    num_conv: this.num_conv,
                    date_constat: this.date_constat,
                    commentaires: this.commentaires,
                    redaction: this.redaction,
                    infractions: this.infractions_commit,
                    amande: this.amande,
                    products_saisie: this.products_saisie,
                    sommeqte: this.sommeqte_saisie,
                    sommeDa: this.sommeDa_saisie,
                    category_id: this.category_id,
                    typesaisie_id: this.typesaisie_id,
                    signature: this.signature,
                    date_saisie: this.date_saisie,
                    lieux_saisie: this.lieux_saisie,
                    depot_saisie: this.depot_saisie_id,
                    num_saisie: this.num_saisie
                })
                .then(response => {
                    this.$Progress.start();
                    $("#CreateModal").modal("hide");
                    //this.index();
                    this.showMessage("created successfully", "success");
                    this.$Progress.finish();
                    //axios.get('commercantPvs/'.this.commercant_id)
                    window.location.replace(
                        "home#/commercantPvs/" + this.commercant_id
                    );
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                    this.$Progress.fail();
                });
            //this.initialize();
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
        },
        add_infraction: function() {
            //console.log(response);
            let infraction = this.infractions_commit.find(
                element => element.infraction_id === this.infraction_to_add
            );

            if (infraction !== undefined) {
                alert("existe dejas");
            } else {
                infraction = this.infractions.find(
                    element => element.id === this.infraction_to_add
                );
                //console.log(infraction);
                this.infractions_commit.push({
                    infraction_id: this.infraction_to_add,
                    libelle: infraction.libelle,
                    lois: infraction.lois,
                    lois_p: infraction.lois_p,
                    articles: infraction.articles,
                    articles_p: infraction.articles_p
                });
                this.amande = infraction.amande;
                console.log(infraction);
                //this.index();
            }
        },
        add_product: function() {
            //console.log(response);
            let product = this.products_saisie.find(
                element => element.product_id === this.product_to_add
            );

            if (product !== undefined) {
                alert("existe dejas");
            } else {
                product = this.products.find(
                    element => element.id === this.product_to_add
                );
                //console.log(infraction);
                this.products_saisie.push({
                    product_id: this.product_to_add,
                    libelle: product.libelle,
                    qte: this.qte_to_add,
                    unite: this.unite_to_add,
                    pu: this.pu_to_add,
                    total: this.total_to_add
                });
                //this.index();
            }
        },
        remove_infraction: function(id) {
            //map --- return un tableau
            var removeIndex = this.infractions_commit
                .map(function(item) {
                    return item.infraction_id;
                })
                .indexOf(id);
            //remove un element
            this.infractions_commit.splice(removeIndex, 1);
            //this.index();
        },
        remove_product: function(id) {
            //map --- return un tableau
            var removeIndex = this.products_saisie
                .map(function(item) {
                    return item.product_id;
                })
                .indexOf(id);
            //remove un element
            this.products_saisie.splice(removeIndex, 1);
            //this.index();
        },
        getDate: function() {
            let now = new Date();
            let jour = now.getDate();
            let mois = now.getMonth();
            if (jour < 10) {
                jour = "0" + jour;
            }
            if (mois < 10) {
                mois = "0" + mois;
            }
            return now.getFullYear() + "-" + mois + "-" + jour;
        }
    }
};
</script>
<style scoped>
.card {
    margin-bottom: 0;
}
.rigth-table,
.rigth-table a {
    font-size: 11px;
    padding: 0;
}
</style>
