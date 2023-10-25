<template>

    <div class="pb-5">

        <div class="container-fluid">

                <!-- card content start -->
                <div class="card-content shadow">

                    <!-- card header start -->
                    <div class="p-3 border-bottom">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6">
                                <div class="fs-5">
                                    <i class="bi bi-cloud-fill me-2"></i>
                                    All Login History
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card header end -->

                    <!-- card body start -->
                    <div class="card-body">

                        <!-- loading start -->
                        <div v-if="loading === true">
                            <h6 class="card-text placeholder-glow">
                                <span class="p-2">
                                    <span class="placeholder col-12 py-3 mb-3"></span>
                                </span>
                                <span class="p-2">
                                    <span class="placeholder col-10 py-3 mb-3"></span>
                                </span>
                                <span class="p-2">
                                    <span class="placeholder col-7 py-3 mb-3"></span>
                                </span>
                            </h6>
                        </div>
                        <!-- loading end -->

                        <!-- page no data found start -->
                        <div class="page-no-data-found" v-if="tableData.length === 0 && loading === false">
                            <div class="w-100">
                                <div class="mb-3">
                                    <i class="bi bi-exclamation-circle fs-1"></i>
                                </div>
                                <div class="mb-3">No login history founded</div>
                            </div>
                        </div>
                        <!-- page no data found end -->

                        <div v-if="tableData.length > 0 && loading === false">

                            <!-- card topic start -->
                            <div class="row card-topic">
                                <div class="col-12 col-sm-6 d-none d-sm-block">
                                    Login Time
                                </div>
                            </div>
                            <!-- card topic end -->

                            <!-- card list start -->
                            <div class="row card-list" v-for="(each) in tableData">
                                <div class="col-12 col-sm-6 text-truncate">
                                    <div class="marge-title">
                                        Login Time
                                    </div>
                                        {{each.created_at_formatted}}
                                </div>
                            </div>
                            <!-- card list end -->

                        </div>
                    </div>
                    <!-- card body section end -->

                    <!-- card footer start -->
                    <div class="card-footer py-3 border-top" v-if="tableData.length > 0 && loading === false">
                        <div class="d-flex justify-content-center">
                            <div class="pagination pagination-sm">
                                <div class="page-item" @click="PrevPage">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="bi bi-caret-left-fill"></i>
                                    </a>
                                </div>
                                <div v-if="buttons.length <= 6" class="d-flex">
                                    <div v-for="(page) in buttons" class="page-item" :class="{'active': current_page === page}">
                                        <a class="page-link" @click="pageChange(page)" href="javascript:void(0)" v-text="page"></a>
                                    </div>
                                </div>
                                <div v-if="buttons.length > 6" class="d-flex">
                                    <div class="page-item" :class="{'active': current_page === 1}">
                                        <a class="page-link" @click="pageChange(1)" href="javascript:void(0)">1</a>
                                    </div>
                                    <div v-if="current_page > 3" class="page-item">
                                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)">...</a>
                                    </div>
                                    <div v-if="current_page === buttons.length" class="page-item" :class="{'active': current_page === (current_page - 2)}">
                                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)" v-text="current_page - 2"></a>
                                    </div>
                                    <div v-if="current_page > 2" class="page-item" :class="{'active': current_page === (current_page - 1)}">
                                        <a class="page-link" @click="pageChange(current_page - 1)" href="javascript:void(0)" v-text="current_page - 1"></a>
                                    </div>
                                    <div v-if="current_page !== 1 && current_page !== buttons.length" class="page-item active">
                                        <a class="page-link" @click="pageChange(current_page)" href="javascript:void(0)" v-text="current_page"></a>
                                    </div>
                                    <div v-if="current_page < buttons.length - 1" class="page-item" :class="{'active': current_page === (current_page + 1)}">
                                        <a class="page-link" @click="pageChange(current_page + 1)" href="javascript:void(0)" v-text="current_page + 1"></a>
                                    </div>
                                    <div v-if="current_page === 1" class="page-item" :class="{'active': current_page === (current_page + 2)}">
                                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)" v-text="current_page + 2"></a>
                                    </div>
                                    <div v-if="current_page < buttons.length - 2" class="page-item">
                                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)">...</a>
                                    </div>
                                    <div class="page-item" :class="{'active': current_page === (current_page - buttons.length)}">
                                        <a class="page-link" @click="pageChange(buttons.length)" href="javascript:void(0)" v-text="buttons.length"></a>
                                    </div>
                                </div>
                                <div class="page-item" @click="NextPage">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="bi bi-caret-right-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- card footer end -->

                </div>
                <!-- card content end -->

        </div>
    </div>

</template>

<script>
import apiService from "../../services/apiServices.js";
import apiRoutes from "../../services/apiRoutes.js";
export default {

    data() {

        return {
            loading: false,
            tableData: [],
            formData: {
                limit: 10,
                page: 1
            },
            total_pages: 0,
            current_page: 0,
            buttons: [],
            error: null,
            total_data: 0,
        }

    },

    mounted() {
        this.list();
    },

    methods: {

        list() {
            this.loading = true;
            this.formData.page = this.current_page;
            apiService.POST(apiRoutes.user_login_history, this.formData, (res) => {
                this.loading = false;
                this.selected = [];
                if (res.status === 200) {
                    this.tableData = res.data.data;
                    this.total_data = res.data.total;
                    this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page));
                    this.current_page = res.data.current_page;
                    this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
                }
            });
        },

        PrevPage() {
            if (this.current_page > 1) {
                this.current_page = this.current_page - 1;
                this.list()
            }
        },

        NextPage() {
            if (this.current_page < this.total_pages) {
                this.current_page = this.current_page + 1;
                this.list()
            }
        },

        pageChange(page) {
            this.current_page = page;
            this.list();
        },

    }

}

</script>
